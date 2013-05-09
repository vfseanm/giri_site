<?php
$host = "mysql10.000webhost.com";
$user = "a7487523_root";
$db_name = "a7487523_sticker";
$password= "password1";

$email=$_POST['email'];
$password=$_POST['password'];
$authorized = False;

$con = mysql_connect($host, $user, $password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_name, $con);

$result = mysql_query("SELECT * FROM items");

while($row = mysql_fetch_array($result)) {
	if ($email == $row['email'] && $password == $row['password']) {
		$authorized = True;
	}
}

mysql_close($con);
echo $authorized;

?>