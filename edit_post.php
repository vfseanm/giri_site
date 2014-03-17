<?php

$postid =$_GET["ID"];

include('upload_file.php');

session_start();
<<<<<<< Updated upstream
$file_path = upload_file($_FILES["file"]);
=======
$file_path = upload_file();
>>>>>>> Stashed changes

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$title = $_POST["title"];
	$content = $_POST["content"];
  $teaser = $_POST["teaser"];

<<<<<<< Updated upstream
$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
=======
$con=mysqli_connect("localhost", "admin", "password", "giri");
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );
=======
header( 'Location: http://127.0.0.1:8888/GIRI/post.php?ID='. $postid );
>>>>>>> Stashed changes
}

?>