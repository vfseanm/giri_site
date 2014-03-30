<?php
$id =$_GET["ID"];

include('upload_file.php');
session_start();

upload_file("", $_GET["old_image"]);

$con=mysqli_connect("localhost","giri_user","47nufkXUQIVTnGlg","giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_query($con,"DELETE FROM post WHERE id='$id'");

mysqli_close($con);
header('Location: /blog_home.php');
?>