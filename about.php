 <?php
include('globals.php');

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM about WHERE id=1");

while($row = mysqli_fetch_array($result))
  {
    $headline = $row['headline'];
    $headline = stripslashes($headline);
    $content = $row['content'];
    $content = stripslashes($content);
    $image = $row['image'];
}
mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About GIRI</title>

    <?php 
    include('header_links.php');
    ?>
</head>

<body>

    <?php
    include("navbar.php");
    ?>

    <div class="container">

        <div class="row">
        
            <div class="col-lg-12">
                <h1 class="page-header">About GIRI
                                <?php 
                check_for_error();
                ?>
                  <?php if (loggedin()){ ?>
              <a href="#" data-toggle="modal" data-target="#aboutModal">
             <i class="fa fa-pencil"></i>
        </a>
        <?php } ?>
                </h1>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <img class="img-responsive" src="<?php echo 'upload/' . $image ?>" style="width:100%">
            </div>
            <div class="col-md-6">
                <h2><?php echo $headline ?></h2>
                <p><?php echo $content ?><p>
            </div>

        </div>

   
    </div>

    <br />
    <br />
    <br />

        <?php
    include('footer.php');
    ?>



<!-- **********************Modal************************** -->

<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit About Page</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="edit_about.php" method="POST" enctype="multipart/form-data">
             <div class="form-group">
                <label for="curfile" class="col-sm-2 control-label">Current Image</label>
                <div class="col-sm-10" id="curfile">
                    <?php echo $image ?>
                </div>
            </div>
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Change Image</label>
                <div class="col-sm-10">
                    <input type="file" name="file" id="file">
                </div>
            </div>

  <div class="form-group">
    <label for="headline" class="col-sm-2 control-label">HeadLine</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="headline" name="headline" value="<?php echo $headline ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="content" class="col-sm-2 control-label">Content</label>
    <div class="col-sm-10">
      <textarea id ="content" class="form-control" name="content" style="width:600px"><?php echo $content ?></textarea>
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


<?php 
include("wysiwyg.php");
?>


</body>


</html>
