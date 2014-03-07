<?php

include('upload_file.php');

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$length = $_POST['length'];
	$old_length = $_POST['old_length'];

for($i = 0; $i<$length; $i++){
	echo $i;
	$car = array();
	if($i<$old_length){
		$car[0] = $_POST['old_image'.($i+1)];
	}
	else{
		$car[0] = '';
	}

	$image = $_FILES['carouselfile'.($i+1)];
	$file_path = upload_file($image);
	if ($file_path != 'invalid'){
		$car[0] = $file_path;
	}
	echo $car[0];

	$caption = $_POST["caption". ($i+1)];
	echo $caption;
	$caption = str_replace("\r", "", $caption);
	echo $caption;
	$car[1] = addslashes($caption);


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

//header( 'Location: http://127.0.0.1/projects/GIRI/index.php' );
}

?>