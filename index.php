<?php
include('globals.php');

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM post ORDER BY time_created DESC LIMIT 3");

$posts = array();

while($row = mysqli_fetch_array($result))
  {
    $post = array();
    $post[0] = stripslashes($row['title']);
    $post[1] = stripslashes($row['content']);
    $post[2] = $row['image'];
    $post[3] = $row['time_created'];
    $post[4] = $row['id'];
    $post[5] = stripslashes($row['teaser']);

    $posts[] = $post;
}

mysqli_free_result($result);


$result = mysqli_query($con, "SELECT * FROM home WHERE id=1");

while($row2 = mysqli_fetch_array($result))
  {
    $description = stripslashes($row2['description']);
    $logo_image = $row2['logo_image'];
    $carousel_json = $row2['carousel'];
}
$carousel = json_decode($carousel_json);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Global Inequality Research Initiative | Duke University</title>

    <?php 

    include('header_links.php');

    ?>

    <style type="text/css">
    /* Sticky footer styles
      -------------------------------------------------- */

      html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }



      </style>

</head>

<body>

    <?php
    include("navbar.php");
    ?>


    <div id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <?php
          $count = 0;
          foreach($carousel as $car){
            if(strcmp($car[0],"1")==0){
            ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $count; ?>" <?php if ($count==0) echo 'class="active"'?>></li>
            <?php 
            $count +=1;
          }
          } ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <?php
          $count = 0;
          foreach($carousel as $car){
            if(strcmp($car[0],"1")==0){
            ?>
            <div class="item <?php if ($count==0) echo 'active' ?>">
                <div class="fill" style="background-image:url('upload/<?php echo $car[1]; ?>');"></div>
                <div class="carousel-caption">
                    <?php echo $car[2]; ?>
                    
                </div>
            </div>
            <?php 
            $count +=1;
          } } ?>

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </div>

        <div class="section" style="padding-bottom:25px; padding-top:25px">

        <div class="container">

              <?php
            check_for_error();
        if (loggedin()){
            ?>
              <div class="row">
            <div class="col-lg-12"><p>
        <a href="#" data-toggle="modal" data-target="#carouselModal">
             <i class="fa fa-pencil"></i> Edit Image Carousel
        </a>
      </p>
    </div>
  </div>
        <?php
        }
        ?>

            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <h2 style="color:#622160;" >About GIRI
                      <?php if(loggedin()){ ?>
                                  <a href="#" data-toggle="modal" data-target="#bodyModal">
             <i class="fa fa-pencil"></i>
        </a>
        <?php } ?>
                    </h2>
                    <p><?php echo $description; ?></p>
                    <a class="btn btn-md btn-success" href="about.php" role="button" style="margin-top:20px">Learn More <i class="fa fa-angle-double-right"></i></a>
                    
                </div>
                <div class="col-lg-4 col-md-4">
  <h3 style="color:#622160; margin-top:21px" class="page-header"><i class="fa fa-comments-o"></i> News</h3>
    <?php
    foreach($posts as $post){
      ?>
                    <a href="post.php?ID=<?php echo $post[4] ?>"><?php echo $post[0] ?></a>
                    <p>
                      <?php echo substr($post[5], 0, 85); ?></p>
                    <?php
                  }
                  ?>

</div>
</div>
</div>
    </div>
    <!-- /.section -->

   

    <?php
    include('footer.php');
    ?>


<!-- **********************Modal************************** -->

<div class="modal fade" id="bodyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Body</h4>
      </div>
      <div class="modal-body">


<form class="form-horizontal" role="form" action="edit_index.php" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <textarea id ="description" class="form-control" name="description" style="width:600px"><?php echo $description ?></textarea>
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


<!-- ********************** Carousel Modal ************************** -->

<div class="modal fade" id="carouselModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Image Carousel</h4>
      </div>
      <div class="modal-body">

<form class="form-horizontal" role="form" action="edit_carousel.php" method="POST" enctype="multipart/form-data">

<div class="panel-group" id="accordion">
  <?php
      $count = 1;
      foreach($carousel as $car){
      ?>
  <div class="panel panel-default" id="car<?php echo $count; ?>">
    <div class="panel-heading" style="height:35px">
      <h4 class="panel-title" style="float:left">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $count; ?>">
          Panel <?php echo $count; ?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $count; ?>" class="panel-collapse collapse <?php if ($count==1) echo 'in' ?>">
      <div class="panel-body">
        <div class="form-group">
                <label for="active<?php echo $count; ?>" class="col-sm-2 control-label">Active</label>
                <div class="col-sm-10" id="active<?php echo $count; ?>" >
                  <input type="checkbox" name="active<?php echo $count; ?>" <?php if (strcmp($car[0], "1")==0) echo 'checked' ?> >
                </div>
          </div>
      
          <div class="form-group">
                <label for="carouself<?php echo $count; ?>" class="col-sm-2 control-label">Current Image</label>
                <div class="col-sm-10" id="carouself<?php echo $count; ?>">
                    <?php echo $car[1] ?>
                </div>
            </div>
            <div class="form-group">
                <label for="carouselfile<?php echo $count; ?>" class="col-sm-2 control-label">Change Image</label>
                <div class="col-sm-10">
                    <input type="file" name="carouselfile<?php echo $count; ?>" id="carouselfile<?php echo $count; ?>">
                </div>
            </div>
            <div class="form-group">
    <label for=" <?php echo $count; ?>" class="col-sm-2 control-label">Caption</label>
    <div class="col-sm-10">
      <textarea id ="caption<?php echo $count; ?>" class="form-control" name="caption<?php echo $count; ?>" style="width:600px; height:50px"><?php echo $car[2] ?></textarea>
    </div>
  </div>
  <input type="hidden" value='<?php echo $car[1] ?>' name="old_image<?php echo $count; ?>">
       </div>
    </div>
  </div>

  <?php 
  $count +=1;
}
?>

</div>

 <div class="form-group">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </div>
</form>


      </div>
    </div>
  </div>
</div>

<!-- **********************End Carousel Modal************************** -->
    

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

<?php 
include("wysiwyg.php");
?>

</body>

</html>