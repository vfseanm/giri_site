<?php

//Configure and Connect to the Databse
$host = "localhost";
$user = "root";
$db_name = "stickershock";
$password= "root";

 $con = mysql_connect($host, $user, $password);

 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }

 mysql_select_db($db_name, $con);

 //Pull data from home.php front-end page

 $storeName=$_POST['storeName'];
 $itemName=$_POST['itemName'];
 $itemPrice=$_POST['itemPrice'];
 $desiredPrice=$_POST['desiredPrice'];
 $link = $_POST['link'];

 //Insert Data into mysql

$query=mysql_query("INSERT INTO items(storeName,itemName,itemPrice,desiredPrice,link) VALUES('$storeName','$itemName','$itemPrice', '$desiredPrice', '$link')");

if($query){
echo "Data for $name inserted successfully!";
}

else{ echo "An error occurred!"; }
mysql_close($con);

//sending the user an email
$to = "danthaman44@gmail.com";
$subject = "StickerShock item added!";
$message = "You just added an item to StickerShock";
$from = "noreply@stickershock.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";

?>
