<?php

include('../upload_file.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_POST["name"];
	$name = addslashes($name);
	$startdate = $_POST["startdate"];
	$enddate = $_POST["enddate"];
	$teaser = $_POST["teaser"];
	$teaser = addslashes($teaser);
	$description = $_POST["description"];
	$description = addslashes($description);
	$image = $_FILES["file"];
	$file_path = upload_file($image);

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($file_path == 'invalid'){
	$result = mysqli_query($con, "INSERT INTO events (name, startdate, enddate, teaser, description) VALUES ('$name', '$startdate', '$enddate', '$teaser', '$description')");
}
else{
	$result = mysqli_query($con, "INSERT INTO events (name, startdate, enddate, image, teaser, description) VALUES ('$name', '$startdate', '$enddate', '$file_path', '$teaser', '$description')");
}

mysqli_close($con);

$redirect = "/events/events_home.php";
header('Location: ' . $redirect);
}

?>