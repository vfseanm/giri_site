<?php

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM footer WHERE id=1");

while($row = mysqli_fetch_array($result))
  {
    $address_one = stripslashes($row['address_one']);
    $address_two = stripslashes($row['address_two']);
    $address_three = stripslashes($row['address_three']);
    $phone = $row['phone'];
}

mysqli_free_result($result);

$result = mysqli_query($con, "SELECT * FROM footer_links LIMIT 6");

$links = array();
$count = 0;
while($row = mysqli_fetch_array($result))
  {
    $link = array();
    $link[1] = stripslashes($row['anchor']);
    $link[0] = stripslashes($row['link']);

    $links[] = $link;

    $count  +=1;
}

while($count<7){
  $link = array();
  $link[0] = "";
  $link[1] = "";
  $links[] = $link;

  $count  +=1;

}

mysqli_close($con);

?>

<div id="footer" style="background-color: #f5f5f5; height:auto">
      <div class="container" style="padding-top:15px">
        <div class="row">
          <div class="col-lg-4 col-md-4">
            <p class="footer_heading" >Contact <?php if (loggedin()){ ?>
              <a href="#" data-toggle="modal" data-target="#footerModal">
             <i class="fa fa-pencil"></i>
        </a>
        <?php } ?>
            </p>
          <address>
            <i class="fa fa-envelope"></i> <?php echo $address_one ?><br>
              <?php echo $address_two ?><br>
              <?php echo $address_three ?><br>
          </address>
          <p><i class="fa fa-phone"></i> <?php echo $phone ?></p>
        </div>
        <div class="col-lg-4 col-md-4">

          <p class="footer_heading">Links<?php if (loggedin()){ ?>
              <a href="#" data-toggle="modal" data-target="#footerLinksModal">
             <i class="fa fa-pencil"></i>
        </a>
        <?php } ?>
          </p>
          <?php foreach($links as $link){ ?>
          <a href="<?php echo $link[1] ?>"><?php echo $link[0] ?></a><br>
          <?php } ?>

        </div>
        <div class="col-lg-4 col-md-4">
          <p class="footer_heading">Share</p>
          <h1 style="margin-top:0px; margin-bottom:20px"><a href="https://www.facebook.com/GlobalInequalityInitiative" style="color:#3B5998"><i class="fa fa-facebook-square"></i></a>
            <a href="https://twitter.com/GIRIatDuke " style="color:##55acee"><i class="fa fa-twitter-square"></i></a>
          </h1>

        <?php if (!loggedin()){ ?>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
       Manage Site
    </button>
    <?php }
    else {?>
    <a href="/logout.php" class="btn btn-primary btn-sm">
       Logout
    </a>
    <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newAdminModal">
       Add Administrator
    </a>
  <?php } ?>
</div>
</div>
      </div>
    </div>


<!-- **********************Modal************************** -->

<div class="modal fade" id="footerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Contact</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="/edit_footer.php" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="address_one" class="col-sm-2 control-label">Address Line 1</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="address_one" name="address_one" value="<?php echo $address_one ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="address_two" class="col-sm-2 control-label">Address Line 2</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="address_two" name="address_two" value="<?php echo $address_two ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="address_three" class="col-sm-2 control-label">Address Line 3</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="address_three" name="address_three" value="<?php echo $address_three ?>">
    </div>
  </div>

    <div class="form-group">
    <label for="phone" class="col-sm-2 control-label">Phone #</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone ?>">
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
<!-- **********************End Modal************************** -->



<!-- **********************Footer Links Modal************************** -->

<div class="modal fade" id="footerLinksModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Footer Links</h4>
      </div>
      <div class="modal-body">

    <form class="form-horizontal" role="form" action="/edit_footer_links.php" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="address_one" class="col-lg-2 control-label">Link 1</label>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_one" name="link_one_anchor" value="<?php echo $links[0][1] ?>">
    </div>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_one" name="link_one_link" value="<?php echo $links[0][0] ?>">
    </div>
  </div>
    <div class="form-group">
    <label for="address_two" class="col-lg-2 control-label">Link 2</label>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_two" name="link_two_anchor" value="<?php echo $links[1][1] ?>">
    </div>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_two" name="link_two_link" value="<?php echo $links[1][0] ?>">
    </div>
  </div>
    <div class="form-group">
    <label for="address_three" class="col-lg-2 control-label">Link 3</label>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_three" name="link_three_anchor" value="<?php echo $links[2][1] ?>">
    </div>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_three" name="link_three_link" value="<?php echo $links[2][0] ?>">
    </div>
  </div>
    <div class="form-group">
    <label for="address_four" class="col-lg-2 control-label">Link 4</label>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_four" name="link_four_anchor" value="<?php echo $links[3][1] ?>">
    </div>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_four" name="link_four_link" value="<?php echo $links[3][0] ?>">
    </div>
  </div>
    <div class="form-group">
    <label for="address_five" class="col-lg-2 control-label">Link 5</label>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_five" name="link_five_anchor" value="<?php echo $links[4][1] ?>">
    </div>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_five" name="link_five_link" value="<?php echo $links[4][0] ?>">
    </div>
  </div>
    <div class="form-group">
    <label for="address_six" class="col-lg-2 control-label">Link 6</label>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_six" name="link_six_anchor" value="<?php echo $links[5][1] ?>">
    </div>
    <div class="col-lg-5 col-sm-5">
      <input type="text" class="form-control" id="address_six" name="link_six_link" value="<?php echo $links[5][0] ?>">
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
<!-- **********************End Footer Links Modal************************** -->




<!-- Admin Login Modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Login as Site Administrator</h4>
      </div>
      <div class="modal-body">

  <form class="form-horizontal" role="form" action="/authenticate.php" method="POST" onsubmit="return validateLoginForm()">
  <div class="form-group">
    <label for="username" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" placeholder="Username" name="username">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" placeholder="Password" name="password">
    </div>
  </div>

      <div id = "validation">
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
  </div>
</form>

      </div>
    </div>
  </div>
</div>


<!-- New Admin Modal -->

<!-- Modal -->
<div class="modal fade" id="newAdminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Site Administrator</h4>
      </div>
      <div class="modal-body">

  <form class="form-horizontal" role="form" action="/new_admin.php" method="POST" onsubmit="return validateNAForm()">
  <div class="form-group">
    <label for="na_username" class="col-sm-4 control-label">New Admin's Username</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="na_username" placeholder="Username" name="na_username">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-4 control-label">New Admin's Password</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="na_password" placeholder="Password" name="na_password">
    </div>
  </div>

  <div class="form-group">
    <label for="password" class="col-sm-4 control-label">Type Password Again</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="na_password_repeat" placeholder="Password" name="na_password_repeat">
    </div>
  </div>

    <div id = "NAvalidation">
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

      </div>
    </div>
  </div>
</div>

<!-- End New Admin Modal -->

<script type = "text/javascript">

function validateLoginForm()
{
var username = document.getElementById("username").value;
var pw = document.getElementById("password").value;

if (username==null || username=="" || pw==null || pw=="")
  {
  $('#validation').html("<div class='alert alert-danger'><p>All fields must be filled in.</p></div>").hide().fadeIn('slow');
  return false;
  }
 
}

function validateNAForm()
{
var username = document.getElementById("na_username").value;
var pw = document.getElementById("na_password").value;
var repeat_password = document.getElementById("na_password_repeat").value;

if (username==null || username=="" || pw==null || pw=="" || repeat_password==null || repeat_password=="")
  {
  $('#NAvalidation').html("<div class='alert alert-danger'><p>All fields must be filled in.</p></div>").hide().fadeIn('slow');
  return false;
  }
  else if(pw != repeat_password){
    $('#NAvalidation').html("<div class='alert alert-danger'><p>The two passwords entered do not match.</p></div>").hide().fadeIn('slow');
  return false;
  }
}

</script>
