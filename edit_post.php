<?php

$postid =$_GET["ID"];

include('upload_file.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$title = $_POST["title"];
	$title = addslashes($title);
	$content = $_POST["content"];
	$content = addslashes($content);
  $teaser = $_POST["teaser"];
  $teaser = addslashes($teaser);
  $video = $_POST["video"];
  $video = addslashes($video);

  $file_path = upload_file($_FILES["file"], $_POST["old_image"]);

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($file_path == 'invalid'){
$result = mysqli_query($con, "UPDATE post SET title='$title', content='$content', teaser='$teaser', embed_code='$video' WHERE id=$postid");
}
else{
$result = mysqli_query($con, "UPDATE post SET title='$title', content='$content', teaser='$teaser', image='$file_path', embed_code='$video' WHERE id=$postid");
}

mysqli_close($con);

$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );
}

?>