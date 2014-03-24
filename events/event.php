<?php
include('../globals.php');

$id =$_GET["ID"];

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM events WHERE id='$id'");

while($row = mysqli_fetch_array($result))
  {
    $name = stripslashes($row['name']);
    $startdate = $row['startdate'];
    $enddate = $row['enddate'];
    $image = $row['image'];
    $teaser = stripslashes($row["teaser"]);
    $description = stripslashes($row['description']);
    $image = $row['image'];
    $id = $row['id'];
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

    <title><?php echo $name ?> - GIRI</title>


    <?php 
    include('../header_links.php');
    ?>

    <link href="/css/datepicker.css" rel="stylesheet">

</head>

<body>

<?php
include('../navbar.php');
?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $name ?>
                <?php
                check_for_error();
                ?>
                <?php if (loggedin()){ ?>
                        <a href="#" data-toggle="modal" data-target="#editEventModal" style="font-size:24px;padding-left:20px">
                            <i class="fa fa-pencil"></i>edit
                        </a>
                        <a href="delete_event.php?ID=<?php echo $id ?>" id = "delete" class="red" style="font-size:24px;padding-left:20px">
                            <i class="fa fa-times"></i>delete
                        </a>
                <?php } ?>
                </h1>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">

                <p class=""><i class="fa fa-clock-o"></i>
                    Start date: <startdate class = "date" style="margin-right:20px"> <?php echo $startdate?> </startdate> 
                    End date: <enddate class = "date"> <?php echo $enddate?> </enddate>  
                </p>
                <hr>
                <?php if ($image != "") { ?>
                <img src="<?php echo '/upload/' . $image ?>" class="img-responsive">
                <?php } ?>
                  <?php if (loggedin() && strcmp($image, "")!=0){ ?>
                    <a class="red" href="delete_event_image.php?ID=<?php echo $id ?>"><i class="fa fa-times"></i>Delete Image</a>
                  <?php } ?>
                
                <?php echo $description ?>

            </div>

            <div class="col-lg-4">
               <?php include("../upcoming_events.php"); ?>
            </div>
        </div>

    </div>

        <?php
    include('../footer.php');
    ?>


    <!-- **********************Modal************************** -->

<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit event</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="edit_event.php?ID=<?php echo $id ?>" method="POST" enctype="multipart/form-data" onsubmit="return validatePostForm()">

            <div class="form-group">
                <label for="curfile" class="col-sm-2 control-label">Current Image</label>
                <div class="col-sm-10" id="curfile">
                    <?php echo $image ?>
                </div>
            </div>
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Upload Image</label>
                <div class="col-sm-10">
                    <input type="file" name="file" id="image">
                </div>
            </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">*Event Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                </div>
              </div>

            <div class="form-group">
              <label for="headline" class="col-sm-2 control-label">*Start Date</label>
              <div class="col-sm-3">
                <input type="text" class="span2" value="<?php echo $startdate ?>" id="dp" name="startdate" data-date-format="yyyy-mm-dd">
              </div>
              <label for="headline" class="col-sm-2 control-label">End Date</label>
              <div class="col-sm-3">
                <input id = "dp2" type="text" class="span2" value="<?php echo $enddate ?>" name="enddate" data-date-format="yyyy-mm-dd">
              </div>
            </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Teaser</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="teaser" name="teaser" value="<?php echo $teaser ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea id ="description" class="form-control" name="description" value = "" style="width:600px"><?php echo $description ?></textarea>
                </div>
              </div>

              <div id = "postValidation">
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



    <!-- JavaScript -->

    <!-- JavaScript -->

<script src="/js/jquery-1.10.2.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/event.js"> </script>
<script type="text/javascript">
    function validatePostForm() {
    var title = document.getElementById("name").value;
    if (title==null || title=="")
      {
      $('#postValidation').html("<div class='alert alert-danger'><p>You must name the event.</p></div>").hide().fadeIn('slow');
      return false;
      }
    }
</script>

<?php 
include("../wysiwyg.php");
?>

</body>

</html>
