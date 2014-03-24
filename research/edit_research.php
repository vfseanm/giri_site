<?php

$postid = $_GET["ID"];

include('../upload_file.php');

session_start();

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
$result = mysqli_query($con, "UPDATE research SET title='$title', publishdate='$date', location='$location', authors='$authors', summary='$summary' WHERE id=$postid");
}
else{
$result = mysqli_query($con, "UPDATE research SET title='$title', publishdate='$date', location='$location', authors='$authors', summary='$summary', document='$file_path' WHERE id=$postid");
}

mysqli_close($con);

$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );
}

?>