<?php

include('../upload_file.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = addslashes($_POST["name"]);
	$name = trim($name);
	$splitname = explode(" ", $name);
	$lastname = $splitname[1];
	$position = addslashes($_POST["position"]);
	$description = addslashes($_POST["description"]);
	$role = $_POST["role"];
	$link1 =  $_POST["link1"];
	$link2 =  $_POST["link2"];
	$link3 =  $_POST["link3"];
	$link1name =  $_POST["link1name"];
	$link2name =  $_POST["link2name"];
	$link3name =  $_POST["link3name"];
	$image = $_FILES["file"];
	$file_path = upload_file($image);

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($file_path == 'invalid'){
	$result = mysqli_query($con, "INSERT INTO people (name, lastname, position, description, role, link1, link2, link3, link1name, link2name, link3name) VALUES ('$name', '$lastname', '$position', '$description', '$role', '$link1', '$link2', '$link3', '$link1name', '$link2name', '$link3name')");
}
else{
	$result = mysqli_query($con, "INSERT INTO people (name, lastname, position, description, role, link1, link2, link3, link1name, link2name, link3name, picture) VALUES ('$name', '$lastname', '$position', '$description', '$role', '$link1', '$link2', '$link3', '$link1name', '$link2name', '$link3name', '$file_path')");
}

mysqli_close($con);

$redirect = "/people/people.php";
header('Location: ' . $redirect);
}

?>