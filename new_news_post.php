<?php

include('upload_file.php');

session_start();
$file_path = upload_file($_FILES["file"]);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$title = $_POST["title"];
	$title = addslashes($title);
	$content = $_POST["content"];
	$content = addslashes($content);
	$teaser = $_POST["teaser"];
	$teaser = addslashes($teaser);
	$video = $_POST["video"];
	$video= addslashes($video);

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $timestamp = time();
if ($file_path == 'invalid'){
$result = mysqli_query($con, "INSERT INTO post (time_created, title, teaser, embed_code, content) VALUES ('$timestamp', '$title', '$teaser', '$video', '$content')");
}
else{
$result = mysqli_query($con, "INSERT INTO post (time_created, title, teaser, content, embed_code, image) VALUES ('$timestamp', '$title', '$teaser', '$content', '$video', '$file_path') ");
}

mysqli_close($con);
$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );

}

?>