<?php
include('globals.php');

$con=mysqli_connect("localhost", "admin", "password", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM post ORDER BY time_created DESC LIMIT 4");

$posts = array();

while($row = mysqli_fetch_array($result))
  {
    $post = array();
    $post[0] = $row['title'];
    $post[1] = $row['content'];
    $post[2] = $row['image'];
    $post[3] = $row['time_created'];
    $post[4] = $row['id'];
    $post[5] = $row['teaser'];

    $posts[] = $post;
}
mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>News - GIRI</title>

    <?php 
    include('header_links.php');
    ?>
</head>

<body>

    <?php
    include("navbar.php");
    ?>

    <div class="container">

        <div class="row">

            <?php
            check_for_error();
        if (loggedin()){
            ?>

            <div class="col-lg-12">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newPostModal">
                New News Post
                </button>
            </div>
        <?php
        }
        ?>

            <div class="col-lg-12">
                <h1 class="page-header">GIRI News
                </h1>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">

                <?php 
                foreach($posts as $post){
                    ?>    
                    <div class="row">
                    <div class="col-lg-4"> 
                    <?php 
                if ($post[2] != ""){
                ?>
                <a href="post.php?ID=<?php echo $post[4] ?>">
                    <img src="upload/<?php echo $post[2] ?>" class="img-responsive">
                </a>
                <?php } ?>
                <br >
                <a class="btn btn-success" href="post.php?ID=<?php echo $post[4] ?>">Read More <i class="fa fa-angle-right"></i></a>
                
            </div>
            <div class="col-lg-8">
                <h2 style="margin-top:0px"><a href="post.php?ID=<?php echo $post[4] ?>"><?php echo $post[0] ?></a>
                </h2>
                <p>Categories: <a href="#">Fake Category</a>
                </p>
                <p><?php echo $post[5] ?>
                </p>
                </div>
            </div>
                <hr>

                <?php 

            }
            ?>

                <ul class="pager">
                    <li class="previous"><a href="#">&larr; Older</a>
                    </li>
                    <li class="next"><a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <div class="col-lg-4">
                
                <!-- /well -->
                <div class="well">
                    <h4>Popular Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#dinosaurs">Dinosaurs</a>
                                </li>
                                <li><a href="#spaceships">Spaceships</a>
                                </li>
                                <li><a href="#fried-foods">Fried Foods</a>
                                </li>
                                <li><a href="#wild-animals">Wild Animals</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#alien-abductions">Alien Abductions</a>
                                </li>
                                <li><a href="#business-casual">Business Casual</a>
                                </li>
                                <li><a href="#robots">Robots</a>
                                </li>
                                <li><a href="#fireworks">Fireworks</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->



        <?php
    include('footer.php');
    ?>



<!-- **********************Modal************************** -->

<div class="modal fade" id="newPostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New News Post</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="new_news_post.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" name="file" id="file">
                </div>
            </div>

  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="title" name="title" value="Title">
    </div>
  </div>
  <div class="form-group">
    <label for="content" class="col-sm-2 control-label">Content</label>
    <div class="col-sm-10">
      <textarea id ="content" class="form-control" rows="8" name="content" style="width:600px">Content</textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </div>
</form>

      </div>
    </div>
  </div>
</div>
<!-- **********************End Modal************************** -->






    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>

<?php 
include("wysiwyg.php");
?>

</body>

</html>
