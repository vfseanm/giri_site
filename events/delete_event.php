<?php
$id =$_GET["ID"];
session_start();
$con=mysqli_connect("localhost","admin","password","giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_query($con,"DELETE FROM events WHERE id='$id'");

mysqli_close($con);
header('Location: http://127.0.0.1:8888/GIRI/events/events_home.php');
?>