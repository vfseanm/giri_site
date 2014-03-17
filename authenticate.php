<?php
  	session_start();
    $current_link = $_SERVER["HTTP_REFERER"];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST["username"];
	$password = $_POST["password"];
if (empty($username))
    {$_SESSION['error'] = 'error';}
else if (empty($password))
    {$_SESSION['error'] = 'error';}
else{
$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM admin_account WHERE username='$username' AND password='$password'");
$count = 0;
while($row = mysqli_fetch_array($result))
  {
  	$count ++;
}
if ($count>0){
  $_SESSION['admin'] = 'True';
}
else{
	$_SESSION['error'] = 'error';
}

mysqli_close($con);
}
header( 'Location: ' . $current_link );
}

?>