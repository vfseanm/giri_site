<?php

$host = "localhost";
$user = "root";
$db_name = "stickershock";
$password= "root";


$con = mysql_connect($host, $user, $password);


if (!$con) 
{ 
die('Could not connect: ' . mysql_error()); 
} 


mysql_select_db($db_name, $con); //Replace with your MySQL DB Name


$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$password=$_POST['password'];
$email=$_POST['email'];


$sql="INSERT INTO users (firstName, lastName, password, email) VALUES ('$firstName', '$lastName', '$password', '$email')"; //*form_data is the name of the MySQL table where the form data will be saved.
//name and email are the respective table fields


if (!mysql_query($sql,$con)) {
die('Error: ' . mysql_error()); 
} 
echo "The form data was successfully added to your database."; 
mysql_close($con);








?>