<?php 

session_start();
$current_link = $_SERVER["HTTP_REFERER"];
$_SESSION['admin'] = 'False';
header( 'Location: ' . $current_link );

?>