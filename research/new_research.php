<?php

include('../upload_file.php');

session_start();
$type = $_GET["TYPE"];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$title = addslashes($_POST["title"]);
	$date = $_POST["date"];
	$location = addslashes($_POST["location"]);
	$authors = addslashes($_POST["authors"]);
	$summary = addslashes($_POST["summary"]);
	$doc = $_FILES["file"];
	$file_path = upload_file($doc);

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($file_path == 'invalid'){
	$result = mysqli_query($con, "INSERT INTO research (title, publishdate, location, authors, summary, type) VALUES ('$title', '$date', '$location', '$authors', '$summary', '$type')");
}
else{
	$result = mysqli_query($con, "INSERT INTO research (title, publishdate, location, authors, summary, document, type) VALUES ('$title', '$date', '$location', '$authors', '$summary', '$file_path', '$type')");
}

mysqli_close($con);

$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );
}

?>