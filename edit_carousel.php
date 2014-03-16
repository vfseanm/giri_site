<?php

include('upload_file.php');

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST")
{

for($i = 0; $i<6; $i++){
	echo $i;
	$car = array();

	if(isset($_POST['active'. ($i+1)])){
		$car[0] = "1";
	}
	else{
		$car[0] = "0";
	}

	$image = $_FILES['carouselfile'.($i+1)];
	$file_path = upload_file($image);
	if ($file_path != 'invalid'){
		echo 'new image';
		$car[1] = $file_path;
	}
	else{
		$car[1] = $_POST['old_image'.($i+1)];
	}
	echo $car[1];

	$caption = $_POST["caption". ($i+1)];
	$cap = addslashes($caption);
	$cap = str_replace(array("\n", "\r"), '', $cap);
	$car[2] = $cap;

	$carousel[$i] = $car;

}

$con=mysqli_connect("localhost", "admin", "password", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$carousel = json_encode($carousel);
$result = mysqli_query($con, "UPDATE home SET carousel='$carousel' WHERE id=1");


mysqli_close($con);

header( 'Location: http://127.0.0.1/projects/GIRI/giri_site/index.php' );
}

?>