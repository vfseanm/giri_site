<?php
include('../globals.php');

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM events WHERE startdate > DATE_SUB(CURDATE(),INTERVAL 5 DAY) ORDER BY startdate LIMIT 4");

$events = array();

while($row = mysqli_fetch_array($result))
  {
    $event = array();
    $event[0] = stripslashes($row['name']);
    $event[1] = $row['startdate'];
    $event[2] = stripslashes($row['description']);
    $event[3] = $row['image'];
    $event[4] = $row['id'];
    $event[5] = $row['enddate'];
    $event[6] = stripslashes($row['teaser']);
    $events[] = $event;
}
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Events - GIRI</title>

    <?php 
    include('../header_links.php');
    ?>

    <link href="/css/datepicker.css" rel="stylesheet">
    <style>
    .img-responsive.main {
      display: block;
      max-width: 100%;
      max-height: 40%;
    }
    </style>

</head>

<body>

    <?php
    include("../navbar.php");
    ?>

    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">GIRI Events
                <?php
                check_for_error();
                ?>
                 <?php
                if (loggedin()){
                    ?>
                        <a href="#" data-toggle="modal" data-target="#eventModal" style="font-size:18px">
                        <i class="fa fa-plus"></i> New Event
                        </a>
                <?php
                }
                ?>
                 </h1>
            </div>
        </div>

        <div id="contents">

        <?php 
         foreach($events as $event){
        ?>    

        <div class="row">

            <div class="col-md-4">
                <a href="/events/event.php?ID=<?php echo $event[4]?>">        
                    <?php if ($event[3] != "") { ?>
                        <img src="/upload/<?php echo $event[3]?>" class="img-responsive main">
                    <?php } else { ?>
                        <img src="/events/default_event.png" class="img-responsive main">
                    <?php } ?>
                </a>
            </div>
            <div class="col-md-8">
                <h3>
                    <a href="event.php?ID=<?php echo $event[4] ?>" class = "eventname"><?php echo $event[0]?></a>
                </h3>
                <p class = "startdate">From: <b><?php echo $event[1] ?></b> to <b><?php echo $event[5] ?></b> </p>
                </p>
                <p><?php echo $event[6] ?></p>
                <a class="btn btn-success" href="event.php?ID=<?php echo $event[4] ?>">Read More <i class="fa fa-angle-right"></i></a>
            </div>

        </div>

        <hr>

        <?php 
          }
        ?>
    </div>

    <div class="loading" id="loading">Loading More</div>
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

        <form class="form-horizontal" role="form" action="new_event.php" method="POST" enctype="multipart/form-data" onsubmit="return validatePostForm()">
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Upload Image</label>
                <div class="col-sm-10">
                    <input type="file" name="file" id="image">
                </div>
            </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">*Event Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name">
                </div>
              </div>

            <div class="form-group">
              <label for="headline" class="col-sm-2 control-label">*Start Date</label>
              <div class="col-sm-3">
                <input id = "startdate" type="text" class="span2" value="" name="startdate" data-date-format="yyyy-mm-dd">
              </div>
               <label for="headline" class="col-sm-2 control-label">End Date</label>
              <div class="col-sm-3">
                <input id = "enddate" type="text" class="span2" value="" name="enddate" data-date-format="yyyy-mm-dd">
              </div>
            </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Teaser</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="teaser" name="teaser">
                </div>
              </div>

              <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="description" style="width:600px"></textarea>
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
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/events.js"> </script>

        <?php 
    include("../wysiwyg.php");
    ?>

<script type="text/javascript" src="/js/scrollpagination.js"></script>

    <script type="text/javascript">
    function validatePostForm() {
    var title = document.getElementById("name").value;
    if (title==null || title=="")
      {
      $('#postValidation').html("<div class='alert alert-danger'><p>You must name the event.</p></div>").hide().fadeIn('slow');
      return false;
      }
    }

var page = -1;
var children = $('#contents').children().size();
$('#loading').fadeOut();
$(function(){
    $('#contents').scrollPagination(
        {
        'contentPage': 'events_home_content.php', // the url you are fetching the results
        'contentData': {'page': function() {return page}}, // these are the variables you can pass to the request, for example: children().size() to know which page you are
        'scrollTarget': $(window), // who gonna scroll? in this example, the full window
        'heightOffset': 10, // it gonna request when scroll is 10 pixels before the page ends
        'beforeLoad': function(){ // before load function, you can display a preloader div
            page ++;
            console.log(page);
            $('#loading').fadeIn(); 
        },
        'afterLoad': function(elementsLoaded){ // after loading content, you can use this function to animate your new elements
             $('#loading').fadeOut();
             var i = 0;
             $(elementsLoaded).fadeInWithDelay();
             if ($('#contents').children().size() == children){ // no more results
                 $('#contents').stopScrollPagination();
                 console.log("stopping pagination!");
            }
            else{
                children = $('#contents').children().size();
            }
        }
    });
    
    // code for fade in element by element
    $.fn.fadeInWithDelay = function(){
        var delay = 0;
        return this.each(function(){
            $(this).delay(delay).animate({opacity:1}, 200);
            delay += 100;
        });
    };
           
});
</script>

</body>

</html>
