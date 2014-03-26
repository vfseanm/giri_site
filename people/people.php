<?php
include('../globals.php');

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result_faculty = mysqli_query($con, "SELECT * FROM people WHERE role = 'Faculty' ORDER BY name");
$result_staff = mysqli_query($con, "SELECT * FROM people WHERE role = 'Staff' ORDER BY name");
$result_fellows = mysqli_query($con, "SELECT * FROM people WHERE role = 'Fellow' ORDER BY name");

$faculties = array();
while($row = mysqli_fetch_array($result_faculty))
  {
    $faculty = array();
    $faculty[0] = stripslashes($row['name']); $faculty[1] = stripslashes($row['position']); $faculty[2] = stripslashes($row['description']);
    $faculty[3] = $row['picture']; $faculty[4] = $row['link1name']; $faculty[5] = $row['link1'];
    $faculty[6] = $row['link2name']; $faculty[7] = $row['link2']; $faculty[8] = $row['link3name'];
    $faculty[9] = $row['link3']; $faculty[10] = $row['role']; $faculty[11] = $row['id'];
    $faculties[] = $faculty;
}

$staffs = array();
while($row = mysqli_fetch_array($result_staff))
  {
    $staff= array();
    $staff[0] = stripslashes($row['name']); stripslashes($staff[1] = $row['position']); $staff[2] = stripslashes($row['description']);
    $staff[3] = $row['picture']; $staff[4] = $row['link1name']; $staff[5] = $row['link1'];
    $staff[6] = $row['link2name']; $staff[7] = $row['link2']; $staff[8] = $row['link3name'];
    $staff[9] = $row['link3']; $staff[10] = $row['role']; $staff[11] = $row['id'];
    $staffs[] = $staff;
}

$fellows = array();
while($row = mysqli_fetch_array($result_fellows))
  {
    $fellow= array();
    $fellow[0] = stripslashes($row['name']); $fellow[1] = stripslashes($row['position']); $fellow[2] = stripslashes($row['description']);
    $fellow[3] = $row['picture']; $fellow[4] = $row['link1name']; $fellow[5] = $row['link1'];
    $fellow[6] = $row['link2name']; $fellow[7] = $row['link2']; $fellow[8] = $row['link3name'];
    $fellow[9] = $row['link3']; $fellow[10] = $row['role']; $fellow[11] = $row['id'];
    $fellows[] = $fellow;
}
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>People - GIRI</title>

    <?php 
    include('../header_links.php');
    ?>
    <style>
    .img-responsive.main {
      display: block;
      max-width: 85%;
      max-height: 200px;
    }
    </style>
</head>

<body>

    <?php
    include('../navbar.php');
    ?>

    <!-- Page Content -->

    <div class="container" style="min-height:100%; margin-bottom:-205px; height:auto">


        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">People
                <?php
                check_for_error();
                ?>
                <?php
                if (loggedin()){
                    ?>
                        <a href="#" data-toggle="modal" data-target="#addPersonModal" style="font-size:18px">
                        <i class="fa fa-plus"></i> Add Person
                        </a>
                <?php
                }
                ?>
                </h1>
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#service-one" data-toggle="tab">Faculty</a>
                    </li>
                    <li><a href="#service-two" data-toggle="tab">Staff</a>
                    </li>
                    <li><a href="#service-three" data-toggle="tab">Fellows</a>
                    </li>
<!--                     <li><a href="#service-four" data-toggle="tab">Team</a>
                    </li> -->
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="service-one">
                    <?php 
                      foreach($faculties as $faculty){
                    ?>    
                      <div class="row">
                         <div class="col-md-3">
                          <?php if ($faculty[3] != "") { ?>
                               <img id = "picture_<?php echo $faculty[11]?>" class="img-responsive main" src="/upload/<?php echo $faculty[3]?>">
                          <?php } else { ?>
                              <img id = "picture_<?php echo $faculty[11]?>" class="img-responsive main" src="no-picture.png">
                          <?php } ?>
                          <?php if (loggedin() && strcmp($faculty[3], "")!=0){ ?>
                            <a class="red" href="delete_person_picture.php?ID=<?php echo $faculty[11] ?>"><i class="fa fa-times"></i>Delete Image</a>
                          <?php } ?>
                         </div>
                            <div class="col-md-9">
                            <h3> 
                              <b id = "name_<?php echo $faculty[11]?>"> <?php echo $faculty[0]?> </b>
                              <small id = "position_<?php echo $faculty[11]?>"><?php echo $faculty[1]?> </small>
                              <?php if (loggedin()){ ?>
                                  <a href="#" data-toggle="modal" data-target="#editPersonModal">
                                       <i class="fa fa-pencil main" style = "color:#428bca;" id ="<?php echo $faculty[11]?>"></i>
                                  </a>
                                  <a href="delete_person.php?ID=<?php echo $faculty[11]?>" class = "delete">
                                       <i class="fa fa-times" style = "color:#f04124; float: right"></i>
                                  </a>
                              <?php } ?>
                            </h3>
                            <desc id = "desc_<?php echo $faculty[11]?>"> <?php echo $faculty[2]?> </desc>
                            <p>
                               <a id = "link1_<?php echo $faculty[11]?>" href="<?php echo $faculty[5]?>"><?php echo $faculty[4]?></a> | 
                               <a id = "link2_<?php echo $faculty[11]?>" href="<?php echo $faculty[7]?>"><?php echo $faculty[6]?></a> | 
                               <a id = "link3_<?php echo $faculty[11]?>" href="<?php echo $faculty[9]?>"><?php echo $faculty[8]?></a>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <?php 
                      }
                    ?>     
                    </div>

                    <div class="tab-pane fade" id="service-two">
                    <?php 
                      foreach($staffs as $staff){
                    ?>    
                      <div class="row">
                         <div class="col-md-3">
                          <?php if ($staff[3] != "") { ?>
                               <img class="img-responsive main" id="picture_<?php echo $staff[11]?>" src="/upload/<?php echo $staff[3]?>">
                          <?php } else { ?>
                              <img class="img-responsive main" id="picture_<?php echo $staff[11]?>" src="no-picture.png">
                          <?php } ?>
                          <?php if (loggedin() && strcmp($staff[3], "")!=0){ ?>
                            <a class="red" href="delete_person_picture.php?ID=<?php echo $staff[11] ?>"><i class="fa fa-times"></i>Delete Image</a>
                          <?php } ?>
                         </div>
                            <div class="col-md-9">
                            <h3> <b id = "name_<?php echo $staff[11]?>"> <?php echo $staff[0]?> </b>
                            <small id = "position_<?php echo $staff[11]?>"><?php echo $staff[1]?> </small> 
                            <?php if (loggedin()){ ?>
                                <a href="#" data-toggle="modal" data-target="#editPersonModal">
                                     <i class="fa fa-pencil main" style = "color:#428bca;" id ="<?php echo $staff[11]?>"></i>
                                </a>
                                <a href="delete_person.php?ID=<?php echo $staff[11]?>" class = "delete">
                                     <i class="fa fa-times" style = "color:#f04124; float: right"></i>
                                </a>
                            <?php } ?>
                            </h3>
                            <desc id = "desc_<?php echo $staff[11]?>"> <?php echo $staff[2]?> </desc>
                            <p><a id = "link1_<?php echo $staff[11]?>" href="<?php echo $staff[5]?>"><?php echo $staff[4]?></a> | 
                               <a id = "link2_<?php echo $staff[11]?>" href="<?php echo $staff[7]?>"><?php echo $staff[6]?></a> | 
                               <a id = "link3_<?php echo $staff[11]?>" href="<?php echo $staff[9]?>"><?php echo $staff[8]?></a>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <?php 
                      }
                    ?> 
                    </div>
                    <div class="tab-pane fade" id="service-three">
                    <?php 
                      foreach($fellows as $fellow){
                    ?>    
                      <div class="row">
                         <div class="col-md-3">
                          <?php if ($fellow[3] != "") { ?>
                               <img class="img-responsive main" src="/upload/<?php echo $fellow[3]?>">
                          <?php } else { ?>
                              <img class="img-responsive main" src="no-picture.png">
                          <?php } ?>
                          <?php if (loggedin() && strcmp($fellow[3], "")!=0){ ?>
                            <a class="red" href="delete_person_picture.php?ID=<?php echo $fellow[11] ?>"><i class="fa fa-times"></i>Delete Image</a>
                          <?php } ?>  
                         </div>
                            <div class="col-md-9">
                            <h3> <b id = "name_<?php echo $fellow[11]?>"> <?php echo $fellow[0]?> </b>
                            <small id = "position_<?php echo $fellow[11]?>"><?php echo $fellow[1]?> </small>
                            <?php if (loggedin()){ ?>
                                <a href="#" data-toggle="modal" data-target="#editPersonModal">
                                     <i class="fa fa-pencil main" style = "color:#428bca;" id ="<?php echo $fellow[11]?>"></i>
                                </a>
                                <a href="delete_person.php?ID=<?php echo $fellow[11]?>" class = "delete">
                                     <i class="fa fa-times" style = "color:#f04124; float: right"></i>
                                </a>                           
                            <?php } ?>
                            </h3>
                            <desc id = "desc_<?php echo $fellow[11]?>"> <?php echo $fellow[2]?> </desc>
                            <p><a id = "link1_<?php echo $fellow[11]?>" href="<?php echo $fellow[5]?>"><?php echo $fellow[4]?></a> | 
                               <a id = "link2_<?php echo $fellow[11]?>" href="<?php echo $fellow[7]?>"><?php echo $fellow[6]?></a> |
                               <a id = "link3_<?php echo $fellow[11]?>" href="<?php echo $fellow[9]?>"><?php echo $fellow[8]?></a>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <?php 
                      }
                    ?>
                    </div>
  <!--                   <div class="tab-pane fade" id="service-four">
                        <div class="row">
                         <div class="col-md-3">
                               <img class="img-responsive" src="sean.png">
                         </div>
                            <div class="col-md-9">
                            <h3> <b> Sean Miller </b> <small>Web Developer</small> <img src="google.png" align="middle" style="max-width:15%; margin-left:370px" > </h3>
                            <p> Sean is a senior at Duke University majoring Computer Science. After graduation, Sean plans to work for
                            Google in Mountain View, CA as a software engineer. Sean has previously interned at Google in 2012 and 2013. Sean
                            has extensive full-stack web development experience in PHP, as well as experience with Django and Ruby on Rails.</p>
                            <p><a href="http://www.linkedin.com/pub/sean-miller/65/95/63b">LinkedIn</a> | <a href="https://github.com/vfseanm/">Github</a> | <a href="http://hurryless.com/">HurryLess</a></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                         <div class="col-md-3">
                               <img class="img-responsive" src="dan.png">
                         </div>
                            <div class="col-md-9">
                            <h3> <b> Dan Deng </b>  <small>Web Developer</small> <img src="linkedin.png" align="middle" style="max-width:15%; margin-left:400px" > </h3>

                            <p>Dan is a senior at Duke University majoring in Computer Science. After graduation, Dan plans to join LinkedIn in
                            Mountain View, CA as a software engineer. Dan previously interned at VMware as a web developer. Dan is a big fan of
                            Ruby on Rails, but has also done PHP and iOS development.</p>
                            <p><a href="https://www.linkedin.com/pub/dan-deng/44/23/ba5/">LinkedIn</a> | <a href="https://github.com/danthaman44">Github</a> | <a href="http://people.duke.edu/~wdd3/isis240/">Duke</a></p>
                        </div>
                    </div>
                    <hr>
                    </div> -->
                    
                </div>
            </div>

        </div>
        <!-- /.row -->
<!-- ********************** Add Modal************************** -->

<div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add a person</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="new_person.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Upload Picture</label>
                <div class="col-sm-10">
                    <input type="file" name="file">
                </div>
            </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name">
                </div>
              </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Position</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="position" placeholder = "Program Director">
                </div>
              </div>

            <div class="form-group">
              <label for="headline" class="col-sm-2 control-label">Role</label>
                <div class="col-sm-2">
                  <select class="form-control" name = "role">
                    <option value="Faculty">Faculty</option>
                    <option value="Staff">Staff</option>
                    <option value="Fellow">Fellow</option>
                  </select>
                </div>
            </div>

              <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="description" style="width:600px"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Link #1 name</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="link1name">
                </div>
                <label for="headline" class="col-sm-2 control-label">Link #1</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="link1">
                </div>
              </div>
              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Link #2 name</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="link2name">
                </div>
                <label for="headline" class="col-sm-2 control-label">Link #2</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="link2">
                </div>
              </div>
              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Link #3 name</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="link3name">
                </div>
                <label for="headline" class="col-sm-2 control-label">Link #3</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="link3">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>

      </div>
    </div>
  </div>
</div>
<!-- **********************End Add Modal************************** -->
<!-- ********************** Edit Modal************************** -->

<div class="modal fade" id="editPersonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit person</h4>
      </div>
      <div class="modal-body">

        <form id = "editform" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="curfile" class="col-sm-2 control-label">Current Picture</label>
                <div class="col-sm-10" id="cur_picture">

                </div>
            </div>
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Upload Picture</label>
                <div class="col-sm-10">
                    <input type="file" name="file" id="picture">
                </div>
            </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name">
                </div>
              </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Position</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="position" name="position">
                </div>
              </div>

            <div class="form-group">
              <label for="headline" class="col-sm-2 control-label">Role</label>
                <div class="col-sm-2">
                  <select class="form-control" name = "role" id = "role">
                    <option value="Faculty">Faculty</option>
                    <option value="Staff">Staff</option>
                    <option value="Fellow">Fellow</option>
                  </select>
                </div>
            </div>

              <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea id ="description" class="form-control" name="description" style="width:600px"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Link #1 name</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="link1name" id = "link1name">
                </div>
                <label for="headline" class="col-sm-2 control-label">Link #1</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="link1" name="link1">
                </div>
              </div>
              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Link #2 name</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="link2name" id = "link2name">
                </div>
                <label for="headline" class="col-sm-2 control-label">Link #2</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="link2" name="link2">
                </div>
              </div>
              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Link #3 name</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="link3name" id = "link3name">
                </div>
                <label for="headline" class="col-sm-2 control-label">Link #3</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="link3" name="link3">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>

      </div>
    </div>
  </div>
</div>
<!-- **********************End Add Modal************************** -->
        <div style="height:205px">
        </div>
</div>

    <?php
    include('../footer.php');
    ?>

    <!-- JavaScript -->
    <script src="/js/jquery-1.10.2.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/modern-business.js"></script>
    <script src="/js/people.js"></script>

    <?php 
    include("../wysiwyg.php");
    ?>

    

</body>

</html>
