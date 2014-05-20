<?php 

session_start();

$id =$_GET["ID"];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$url = $_POST["url"];
	$caption = $_POST["caption"];
	$caption = addslashes($caption);

	$new_video = array();
	$new_video[] = $url;
	$new_video[] = $caption;

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM events WHERE id='$id'");
$row = mysqli_fetch_array($result);
$videos = json_decode($row['video_gallery']);

$videos[] = $new_video;

$videos = json_encode($videos);

mysqli_query($con, "UPDATE events SET video_gallery='$videos' WHERE id='$id'");

$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );

}

  ?>