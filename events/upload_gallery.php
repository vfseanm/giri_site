<?php
include('upload_image.php');
$id =$_GET["ID"];
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{	
	function reArrayFiles(&$file_post) {
	    $file_ary = array();
	    $file_count = count($file_post['name']);
	    $file_keys = array_keys($file_post);

	    for ($i=0; $i<$file_count; $i++) {
	        foreach ($file_keys as $key) {
	            $file_ary[$i][$key] = $file_post[$key][$i];
	        }
	    }
	    return $file_ary;
	}
	$file_ary = reArrayFiles($_FILES['file']);
	$images = array();
	foreach ($file_ary as $file) {
		$file_path = upload_image($file);
		if ($file_path != "invalid") {
			// $image = array();
			// $image["name"] = $file_path;
			// $images[] = $image;
			$images[] = $file_path;
		}
	}

	$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$result = mysqli_query($con, "SELECT gallery FROM events WHERE id='$id'");
	$row = mysqli_fetch_array($result);
	$current_gallery = json_decode($row['gallery']);
	$merged = array_merge((array)$images, (array)$current_gallery);
	$merged = json_encode($merged);
	$merged = addslashes($merged);
	$result = mysqli_query($con, "UPDATE events SET gallery='$merged' WHERE id=$id");

	mysqli_close($con);

	header( 'Location: /events/gallery/index.php?ID=' . $id);
}

?>