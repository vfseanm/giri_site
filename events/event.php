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
    $name = $row['name'];
    $date = $row['eventdate'];
    $image = $row['image'];
    $description = $row['description'];
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

    <title>Event</title>


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

            <?php
            check_for_error();
        if (loggedin()){
            ?>
            <div class="col-lg-1">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editEventModal">
                Edit Event
                </button>
            </div>
            <div class="col-lg-2">
                 <form class="form-horizontal" role="form" action="delete_event.php?ID=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                    <button type = "submit" class="btn btn-danger btn-sm" id = "delete">
                    Delete Event
                    </button>
                </form>
            </div>
        <?php
        }
        ?>

            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $name ?>
                </h1>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">

                <p class = "date"><i class="fa fa-clock-o"></i> Date: <?php echo $date?> </p>
                <hr>
                <img src="<?php echo '/upload/' . $image ?>" class="img-responsive">
                <hr>
                
                <?php echo $description ?>

            </div>

            <div class="col-lg-4">
                
                <!-- /well -->
                <div class="well">
                    <h4>Popular Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#dinosaurs">Dinosaurs</a>
                                </li>
                                <li><a href="#spaceships">Spaceships</a>
                                </li>
                                <li><a href="#fried-foods">Fried Foods</a>
                                </li>
                                <li><a href="#wild-animals">Wild Animals</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#alien-abductions">Alien Abductions</a>
                                </li>
                                <li><a href="#business-casual">Business Casual</a>
                                </li>
                                <li><a href="#robots">Robots</a>
                                </li>
                                <li><a href="#fireworks">Fireworks</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /well -->
                <div class="well">
                    <h4>Upcoming Events</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#dinosaurs">Great Conference</a>
                                </li>
                                <li><a href="#spaceships">Sweet Conference</a>
                                </li>
                                <li><a href="#fried-foods">Awesome Conference</a>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /well -->
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

        <form class="form-horizontal" role="form" action="edit_event.php?ID=<?php echo $id ?>" method="POST" enctype="multipart/form-data">

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
                <label for="headline" class="col-sm-2 control-label">Event Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                </div>
              </div>

            <div class="form-group">
              <label for="headline" class="col-sm-2 control-label">Event Date</label>
              <div class="col-sm-10">
                <input type="text" class="span2" value="<?php echo $date ?>" id="dp" name="date" data-date-format="yyyy-mm-dd">
              </div>
            </div>

              <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea id ="description" class="form-control" name="description" value = "" style="width:600px"><?php echo $description ?></textarea>
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



    <!-- JavaScript -->

<?php 
include("../wysiwyg.php");
?>
    <!-- JavaScript -->

<script src="/js/jquery-1.10.2.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-datepicker.js"></script>
<script>
    $(function(){    
        rearrangeDate();
        function rearrangeDate() {
            var date = $('.date');
            var old = date.text().substring(6).replace(/ /g,'').split('-');
            var newDate = old[1]+'-'+old[2]+'-'+old[0];
            date.eq(0).html("Date: <strong>" + newDate + "</strong>");
            $('#dp').datepicker({ dateFormat: "yyyy-mm-dd" });
            //$('#dp').val(newDate);
        }
        $('#delete').click(function() {
            var x = confirm("Are you sure you want to delete this event?");
            if (x==true) { // do nothing  
            }
            else
            { 
                return false; //stop the delete
            }
        });
    });
</script>

 

</body>

</html>
