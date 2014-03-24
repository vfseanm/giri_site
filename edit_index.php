<?php

include('upload_file.php');


session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$description = addslashes($_POST["description"]);

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "UPDATE home SET description='$description' WHERE id=1");


mysqli_close($con);

$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );
}

?>