<?php
$id =$_GET["ID"];
$image = $_GET["IMG"];

session_start();

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$result = mysqli_query($con, "SELECT gallery FROM events WHERE id='$id'");
$row = mysqli_fetch_array($result);
$current_gallery = json_decode($row['gallery']);
$new_gallery = array_diff((array)$current_gallery, (array)$image);
$new_gallery = array_values($new_gallery);

$new_gallery = json_encode($new_gallery);
$new_gallery = addslashes($new_gallery);
$result = mysqli_query($con, "UPDATE events SET gallery='$new_gallery' WHERE id=$id");

mysqli_close($con);

$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );

?>

