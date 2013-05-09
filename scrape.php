
<?php
require 'simplehtmldom/simple_html_dom.php';


$host = "localhost";
$user = "root";
$db_name = "stickershock";
$password= "root";

//create db connection

$con = mysql_connect($host, $user, $password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_name, $con);


$result = mysql_query("SELECT * FROM items");
while($row = mysql_fetch_array($result)) {
  $link = $row['link'];
  $name = $row['itemName'];
  $html = file_get_html($link);
  $currentPrice = $html->find('div[class=price js_toPrice]');
  $currentPrice = (string) $currentPrice[0];
  $currentPrice = substr($currentPrice, 32);
  $currentPrice = floatval($currentPrice);
  echo $currentPrice;
  if ($currentPrice <= $row['desiredPrice']) {
     echo "price changed!";
     mysql_query("UPDATE items SET itemPrice = '$currentPrice' WHERE itemName='$name'");
  }

}

mysql_close($con);



?>

