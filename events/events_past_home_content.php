<?php

$page =$_POST["page"];
$page = ($page*4)+4; 


$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM events WHERE startdate < DATE_SUB(CURDATE(),INTERVAL 5 DAY) ORDER BY startdate DESC LIMIT 4 OFFSET $page");

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