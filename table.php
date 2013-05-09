<html lang = "en">
<head>
        <link href="stylesheets/bootstrap.css" rel="stylesheet">

        <script src="http://code.jquery.com/jquery-latest.js">     </script>
        <script src="stylesheets/bootstrap.js"></script>
        <style type="text/css">

        body {background-image:url('images/fabric.png');}
          table.db-table     { border-right:1px solid #ccc; border-bottom:1px solid #ccc; }
table.db-table th  { background:#eee; padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
table.db-table td  { padding:5px; border-left:1px solid #ccc; border-top:1px solid #ccc; }
         
         p {color:red;}

         g {color:red;}

         b {color: green;}

         .delete {color: red;}

        </style>
</head>
<body>
   <div class = "container">
   <div class = "toprow">
     </div>
  <div class = "masthead">
                        <ul class = "nav nav-pills pull-right">
                            <li>
                                <a class="btn btn-link" href="mainpage.html">Main</a>
                            </li>
                            
                             <li class="dropdown">
                                <a class="dropdown-toggle"
                                   data-toggle="dropdown"
                                   href="#">
                                    Account
                                    <b class="caret"></b>
                                  </a>
                                <ul class="dropdown-menu">
                                    <li><a class="btn btn-link" href = "table.php" id = "account">Items</a></li>
                                    <li><a class="btn btn-link" href = "homepage.html">Log Out</a></li>
                                  <!-- links -->
                                </ul>
                              </li>
                      
                         
                        </ul>
                </div>
  <div class = "row"> </div>
    <hr>

<div align = "center">
  <h2> My Wish List </h2>
</div>

<div align = "center">
If the price of any of the items you are tracking falls, the red <g> No </g> will become a green <b> Yes</b>.
Then you are good to go!
<div>
  <div>
    &nbsp
  </div>

<div align="center">


<?php

$host = "localhost";
$user = "root";
$db_name = "stickershock";
$password= "root";

$con = mysql_connect($host, $user, $password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($db_name, $con);

if(isset($_GET['delete'])) {
  $toDelete = $_GET['delete'];
  $sql="DELETE FROM items WHERE itemName='$toDelete'";
  mysql_query($sql);
}


$result = mysql_query("SELECT * FROM items");


echo "<table border='2' class = 'db-table'>
<tr>
<th>Item Name</th>
<th>Store Name</th>
<th>Item Price</th>
<th>Desired Price</th>
<th> URL </th>
<th>Buy?</th>
<th> </th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td> " . $row['itemName'] . " </td>";
  echo "<td> " . $row['storeName'] . " </td>";
  echo "<td>$" . $row['itemPrice'] . " </td>";
  echo "<td>$" . $row['desiredPrice'] . " </td>";
  $url = $row['link'];
  echo "<td> <a href = $url> Link </a> </td>";

if ($row['itemPrice'] > $row['desiredPrice']) {
  echo "<td> <p> No </p> </td>";
 }
 else {
  echo "<td> <b> Yes </b> </td>";
 }
 echo '<td> <div class="record" id="record-',$row['itemName'],'">
        <a href="?delete=',$row['itemName'],'" class="delete">Delete</a>
      </div> <td>';

  echo "</tr>";
  }
echo "</table>";







mysql_close($con);


?>


<div/>


</body>

 <script type="text/javascript">
$(document).ready(function() {

  $('a.delete').click(function(e) {
    e.preventDefault();
    var parent = $(this).parent();
    var grandparent = parent.parent().parent();
    $.ajax({
      type: 'get',
      url: 'table.php',
      data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
      beforeSend: function() {
        grandparent.animate({'backgroundColor':'#fb6c6c'},300);
        confirm("Are you sure you want to delete this item?");
                  },
      success: function() {
        grandparent.slideUp(400,function() {
        grandparent.remove();
        });
      }
    });
  });
});
 </script>

    <div class="navbar navbar-fixed-bottom" align = 'left'>
      <a>  &copy; Dan Deng</a>
    </div>