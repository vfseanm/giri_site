<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$address_one = $_POST["address_one"];
	$address_two = $_POST["address_two"];
	$address_three = $_POST["address_three"];
	$phone = $_POST["phone"];

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "UPDATE footer SET address_one='$address_one', address_two='$address_two', address_three='$address_three', phone='$phone' WHERE id=1");


mysqli_close($con);

$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );
}

?>