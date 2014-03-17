<?php

$postid = $_GET["ID"];

include('../upload_file.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST["name"];
	$date = $_POST["date"];
	$description = $_POST["description"];
	$image = $_FILES["file"];
	$file_path = upload_file($image);

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($file_path == 'invalid'){
$result = mysqli_query($con, "UPDATE events SET name='$name', eventdate='$date',description ='$description' WHERE id=$postid");
}
else{
$result = mysqli_query($con, "UPDATE events SET name='$name', eventdate='$date',description ='$description', image='$file_path' WHERE id=$postid");
}

mysqli_close($con);

header( 'Location: /events/event.php?ID='. $postid );
}

?>