<?php

// to be called upon submission of a form, before a database update.
// returns the name of the file prepended w timestamp like
// 135642356dog_picture.jpg
function upload_file($file){

$allowedExts = array("gif", "jpeg", "jpg", "png");
$extension = end(explode(".", $file["name"]));
if ((($file["type"] == "image/gif")
|| ($file["type"] == "image/jpeg")
|| ($file["type"] == "image/jpg")
|| ($file["type"] == "image/pjpeg")
|| ($file["type"] == "image/x-png")
|| ($file["type"] == "image/png"))
&& ($file["size"] < 1000000)
&& in_array($extension, $allowedExts))
  {
  if ($file["error"] > 0)
    {
    echo "Return Code: " . $file["error"] . "<br>";
    }
  else
    {
    // leave this code just in case eg we need to check size
    /* echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 200000) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>"; */

    // every file is named timestampfile like 12423521dog.jpg
    $file_path = time() . $file["name"];

    // actually upload the file
    move_uploaded_file($file["tmp_name"], "upload/" . $file_path);
    echo "Stored in: " . "upload/" . $file_path;
      
    }
  }
  else {
    return 'invalid';
  }
  return $file_path;
  }

  ?>