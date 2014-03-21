<?php
  	session_start();
    $current_link = $_SERVER["HTTP_REFERER"];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST["na_username"];
	$password = $_POST["na_password"];
  $salt = '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors';
  $hash = crypt($password, $salt);

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "INSERT INTO admin_account (username, password) VALUES ('$username', '$hash')");

if($result==false) {
  $_SESSION['error'] = 'exists';
}
mysqli_close($con);
}
header( 'Location: ' . $current_link );


?>