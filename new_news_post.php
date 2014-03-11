<?php

include('upload_file.php');

session_start();
$file_path = upload_file();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$title = $_POST["title"];
	$content = $_POST["content"];

$con=mysqli_connect("localhost", "admin", "password", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $timestamp = time();
if ($file_path == 'invalid'){
$result = mysqli_query($con, "INSERT INTO post (time_created, title, content) VALUES ('$timestamp', '$title', '$content')");
}
else{
$result = mysqli_query($con, "INSERT INTO post (time_created, title, content, image) VALUES ('$timestamp', '$title', '$content', '$file_path') ");
}

mysqli_close($con);

header( 'Location: http://127.0.0.1:8888/GIRI/blog_home.php');
}

?>