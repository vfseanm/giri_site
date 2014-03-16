<?php

include('upload_file.php');


session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$description = $_POST["description"];

$con=mysqli_connect("localhost", "admin", "password", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "UPDATE home SET description='$description' WHERE id=1");


mysqli_close($con);

header( 'Location: http://127.0.0.1/projects/GIRI/giri_site/index.php' );
}

?>