<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$link_one_anchor = addslashes($_POST["link_one_anchor"]);
$link_one_link = addslashes($_POST["link_one_link"]);
$result = mysqli_query($con, "UPDATE footer_links SET anchor='$link_one_anchor', link='$link_one_link' WHERE id=1");


$link_two_anchor = addslashes($_POST["link_two_anchor"]);
$link_two_link = addslashes($_POST["link_two_link"]);
$result = mysqli_query($con, "UPDATE footer_links SET anchor='$link_two_anchor', link='$link_two_link' WHERE id=2");


$link_three_anchor = addslashes($_POST["link_three_anchor"]);
$link_three_link = addslashes($_POST["link_three_link"]);
$result = mysqli_query($con, "UPDATE footer_links SET anchor='$link_three_anchor', link='$link_three_link' WHERE id=3");


$link_four_anchor = addslashes($_POST["link_four_anchor"]);
$link_four_link = addslashes($_POST["link_four_link"]);
$result = mysqli_query($con, "UPDATE footer_links SET anchor='$link_four_anchor', link='$link_four_link' WHERE id=4");


$link_five_anchor = addslashes($_POST["link_five_anchor"]);
$link_five_link = addslashes($_POST["link_five_link"]);
$result = mysqli_query($con, "UPDATE footer_links SET anchor='$link_five_anchor', link='$link_five_link' WHERE id=5");


$link_six_anchor = addslashes($_POST["link_six_anchor"]);
$link_six_link = addslashes($_POST["link_six_link"]);
$result = mysqli_query($con, "UPDATE footer_links SET anchor='$link_six_anchor', link='$link_six_link' WHERE id=6");


mysqli_close($con);

$current_link = $_SERVER["HTTP_REFERER"];
header( 'Location: ' . $current_link );
}

?>