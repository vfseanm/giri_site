<?php
include('../globals.php');

$page =$_POST["page"];
$page = ($page*8)+10;

$type = $_POST["type"];

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM research WHERE type='$type' ORDER BY publishdate DESC LIMIT 8 OFFSET $page");

$articles = array();

while($row = mysqli_fetch_array($result))
  {
    $article = array();
    $article[0] = stripslashes($row['title']);
    $article[1] = $row['publishdate'];
    $article[2] = stripslashes($row['location']);
    $article[3] = stripslashes($row['authors']);
    $article[4] = stripslashes($row['summary']);
    $article[5] = $row['document'];
    $article[6] = $row['id'];
    $articles[] = $article;
}
mysqli_close($con);
?>

<?php 
                 foreach($articles as $article){
                ?>    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-parent="#accordion" href="#collapseOne">
                                  <strong id = "title_<?php echo $article[6]?>"> <?php echo $article[0] ?> </strong>
                                  <?php if (loggedin()){ ?>
                                  <a href="#" data-toggle="modal" data-target="#editResearchModal">
                                       <i class="fa fa-pencil main" style = "color:#428bca;" id ="<?php echo $article[6]?>"></i>
                                  </a>
                                   <a href="delete_research.php?ID=<?php echo $article[6]?>" class = "delete">
                                       <i class="fa fa-times" style = "color:#f04124; float: right"></i>
                                   </a>
                                  <?php } ?>
                                </a>
                                <p style="margin-top:5px">
                                <small> <date id="date_<?php echo $article[6]?>"><?php echo $article[1] ?></date> | <location id="location_<?php echo $article[6]?>"><?php echo $article[2] ?> </location> | <author id="authors_<?php echo $article[6]?>"><?php echo $article[3] ?> </author> </small>
                                </p>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <summary id="summary_<?php echo $article[6]?>"><?php echo $article[4] ?> </summary>
                            </div>
                            <?php if (!empty($article[5])){ ?>
                            <a class="btn btn-success" href="/upload/<?php echo $article[5]?>" target="_blank" style="margin-left:15px;margin-bottom:10px" id="document_<?php echo $article[6]?>"> View Report
                             <i class="fa fa-angle-right"></i></a>
                             <?php } ?>
                        </div>
                    </div>
                     <?php 
                         }
                      ?>    