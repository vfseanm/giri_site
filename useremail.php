<?php

$to = $_POST['email'];
$subject = "StickerShock registration";
$message = "Congratulations! You have registered for StickerShock";
$from = "noreply@stickershock.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
?>