<?php
include('globals.php');

$page =$_POST["page"];
$page = ($page*4)+4;


$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "select * from post ORDER BY time_created DESC LIMIT 4 OFFSET $page");

$posts = array();

while($row = mysqli_fetch_array($result))
  {
    $post = array();
    $post[0] = stripslashes($row['title']);
    $post[1] = stripslashes($row['content']);
    $post[2] = $row['image'];
    $post[3] = $row['time_created'];
    $post[4] = $row['id'];
    $post[5] = stripslashes($row['teaser']);

    $posts[] = $post;
}
mysqli_close($con);
?>

<?php 
                foreach($posts as $post){
                    ?>    
                    <div class="row">
                    <div class="col-lg-4"> 

                <a href="post.php?ID=<?php echo $post[4] ?>">
                    <?php 
                if ($post[2] != ""){
                ?>
                    <img src="upload/<?php echo $post[2] ?>" class="img-responsive">
                    <?php } 
                    else{
                        ?>
                        <img src="upload/globe.png" class="img-responsive">
                        <?php } ?>
                </a>

                <br >
                <a class="btn btn-success" href="post.php?ID=<?php echo $post[4] ?>">Read More <i class="fa fa-angle-right"></i></a>
                
            </div>
            <div class="col-lg-8">
                <h2 style="margin-top:0px"><a href="post.php?ID=<?php echo $post[4] ?>"><?php echo $post[0] ?></a>
                </h2>                <p><?php echo $post[5] ?>
                </p>
                </div>
            </div>
                <hr>

                <?php 

            }
            ?>