<?php

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
	$result = mysqli_query($con, "INSERT INTO events (name, eventdate, description) VALUES ('$name', '$date', '$description')");
}
else{
	$result = mysqli_query($con, "INSERT INTO events (name, eventdate, image, description) VALUES ('$name', '$date', '$file_path', '$description')");
}

mysqli_close($con);

$redirect = "/events/events_home.php";
header('Location: ' . $redirect);
}

?>