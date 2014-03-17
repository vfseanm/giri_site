<?php

include('upload_file.php');


session_start();
$file_path = upload_file($_FILES["file"]);


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$headline = $_POST["headline"];
	$content = $_POST["content"];

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
	echo 'invalid';
$result = mysqli_query($con, "UPDATE about SET headline='$headline', content='$content' WHERE id=1");
}
else{
$result = mysqli_query($con, "UPDATE about SET headline='$headline', content='$content', image='$file_path' WHERE id=1");
}

mysqli_close($con);

<<<<<<< Updated upstream
$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );
=======
//header( 'Location: http://127.0.0.1/projects/GIRI/giri_site/about.php' );
>>>>>>> Stashed changes
}

?>