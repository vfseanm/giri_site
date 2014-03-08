<?php

include('upload_file.php');


session_start();
$file_path = upload_file($_FILES["file"]);


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$headline = $_POST["headline"];
	$content = $_POST["content"];

$con=mysqli_connect("localhost", "admin", "password", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($file_path == 'invalid'){
	echo 'invalid';
$result = mysqli_query($con, "UPDATE about SET headline='$headline', content='$content' WHERE id=1");
}
else{
$result = mysqli_query($con, "UPDATE about SET headline='$headline', content='$content', image='$file_path' WHERE id=1");
}

mysqli_close($con);

//header( 'Location: http://127.0.0.1/projects/GIRI/giri_site/about.php' );
}

?>