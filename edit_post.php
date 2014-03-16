<?php

$postid =$_GET["ID"];

include('upload_file.php');

session_start();
$file_path = upload_file($_FILES["file"]);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$title = $_POST["title"];
	$content = $_POST["content"];
  $teaser = $_POST["teaser"];

$con=mysqli_connect("localhost", "admin", "password", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($file_path == 'invalid'){
$result = mysqli_query($con, "UPDATE post SET title='$title', content='$content', teaser='$teaser' WHERE id=$postid");
}
else{
  echo 'got here';
$result = mysqli_query($con, "UPDATE post SET title='$title', content='$content', teaser='$teaser', image='$file_path' WHERE id=$postid");
}

mysqli_close($con);

<<<<<<< HEAD
//header( 'Location: http://127.0.0.1/projects/GIRI/giri_site/post.php?ID='. $postid );
=======
header( 'Location: http://127.0.0.1:8888/GIRI/post.php?ID='. $postid );
>>>>>>> e58d2ac8f9e7f63ed6ea80832a247d5ea9cd462b
}

?>