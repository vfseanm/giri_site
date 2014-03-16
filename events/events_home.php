<?php
include('../globals.php');

$con=mysqli_connect("localhost", "admin", "password", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM events ORDER BY eventdate DESC LIMIT 5");

$posts = array();

while($row = mysqli_fetch_array($result))
  {
    $event = array();
    $event[0] = $row['name'];
    $event[1] = $row['eventdate'];
    $event[2] = $row['description'];
    $event[3] = $row['image'];
    $event[4] = $row['id'];
    $events[] = $event;
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

    <title>Events - GIRI</title>

    <?php 
    include('../header_links.php');
    ?>
    <link href="/GIRI/css/datepicker.css" rel="stylesheet">
</head>

<body>

    <?php
    include("../navbar.php");
    ?>

    <div class="container">

        <div class="row">

            <div class="col-lg-3">
                <h1 class="">GIRI Events </h1>
            </div>

            <div class="col-lg-3">
                <?php
                if (loggedin()) {
                ?>
                    <button style = "margin-top:27px;margin-right:50px" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#eventModal">
                        Add Event
                    </button>
                <?php
                 }
                ?>
            </div>

            <div class="col-lg-12">
                <hr style="padding-bottom:2px">
            </div>
        </div>

        <?php 
         foreach($events as $event){
        ?>    

        <div class="row">

            <div class="col-md-5">
                <a href="blog-post.html">
                    <img src="/GIRI/upload/<?php echo $event[3]?>" class="img-responsive">
                </a>
            </div>
            <div class="col-md-7">
                <h3>
                    <a href="event.php?ID=<?php echo $event[4] ?>" class = "eventname"><?php echo $event[0]?></a>
                </h3>
                <p class = "eventdate"><b><?php echo $event[1] ?></b></p>
                </p>
                <p><?php echo $event[2] ?></p>
                <a class="btn btn-success" href="event.php?ID=<?php echo $event[4] ?>">Read More <i class="fa fa-angle-right"></i></a>
            </div>

        </div>

        <hr>

        <?php 
          }
        ?>

        <div class="row">

            <ul class="pager">
                <li class="previous"><a href="#">&larr; Older</a>
                </li>
                <li class="next"><a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

    </div>

    <?php
    include('../footer.php');
    ?>

    <!-- **********************Modal************************** -->

<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add an event</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="new_event.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Upload Image</label>
                <div class="col-sm-10">
                    <input type="file" name="file" id="image">
                </div>
            </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Event Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name">
                </div>
              </div>

            <div class="form-group">
              <label for="headline" class="col-sm-2 control-label">Event Date</label>
              <div class="col-sm-10">
                <input id = "date" type="text" class="span2" value="" id="dp" name="date" data-date-format="yyyy-mm-dd">
              </div>
            </div>

              <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea id ="description" class="form-control" name="description" style="width:600px"></textarea>
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
    include("../wysiwyg.php");
    ?>

    <!-- JavaScript -->
    <script src="/GIRI/js/jquery-1.10.2.js"></script>
    <script src="/GIRI/js/bootstrap.min.js"></script>
    <script src="/GIRI/js/bootstrap-datepicker.js"></script>
    <script src="/GIRI/js/modern-business.js"></script>
    <script>
    $(function(){
        rearrangeDate();
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();
        if(dd<10) { dd='0'+dd }
        if(mm<10) { mm='0'+mm } 
        today = yyyy+'-'+mm+'-'+dd;
        $('#date').val(today);
        $('#date').datepicker({ dateFormat: "yyyy-mm-dd" });

        function rearrangeDate() {
            var dates = $('.eventdate b');
            dates.contents().each(function(i,v) {
                var date = v.textContent.split('-');
                var newDate = date[1]+'-'+date[2]+'-'+date[0];
                dates.eq(i).text(newDate);
            });
        }
    });
    </script>


</body>

</html>
