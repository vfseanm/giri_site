<?php 

session_start();

$id =$_GET["ID"];
$index = $_GET["video"];

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM events WHERE id='$id'");
$row = mysqli_fetch_array($result);

$videos = json_decode($row['video_gallery']);
unset($videos[$index]);
$videos = array_values($videos);
$videos = json_encode($videos);

mysqli_query($con, "UPDATE events SET video_gallery='$videos' WHERE id='$id'");

$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );


  ?>