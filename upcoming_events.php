<?php
$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM events WHERE startdate > DATE_SUB(CURDATE(),INTERVAL 5 DAY) ORDER BY startdate LIMIT 5");

$events = array();

while($row = mysqli_fetch_array($result))
  {
    $event = array();
    $event[0] = stripslashes($row['name']);
    $event[1] = $row['startdate'];
    $event[2] = $row['id'];

    $events[] = $event;
}

mysqli_free_result($result);
?>


                <!-- /well -->
                <div class="well">
                    <h4>Upcoming Events</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                    <?php
                                foreach($events as $event){
                                            ?>
                                <li><a href="/events/event.php?ID=<?php echo $event[2] ?>"><?php echo $event[0] ?></a> <?php echo $event[1] ?>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>