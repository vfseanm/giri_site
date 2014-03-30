<?php
include('globals.php');

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM post ORDER BY time_created DESC LIMIT 8");

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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

            <div class="col-lg-12">
                <h1 class="page-header">GIRI News
            <?php 
                check_for_error();
            ?>
        <?php
        if (loggedin()){
            ?>
                <a href="#" data-toggle="modal" data-target="#newPostModal" style="font-size:18px">
                <i class="fa fa-plus"></i> New News Article
                </a>
        <?php
        }
        ?>
                </h1>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">
                <div id="contents">

                <?php 
                foreach($posts as $post){
                    ?>    
                    <div class="row" style="margin-bottom:15px">
                    
                    
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
            </div>
                
            <div class="col-lg-8">
                <h3 style="margin-top:0px"><a href="post.php?ID=<?php echo $post[4] ?>"><?php echo $post[0] ?></a>
                </h3>
                <p><?php echo $post[5] ?>
                </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12"> 
                <a class="btn btn-success" href="post.php?ID=<?php echo $post[4] ?>">Read More <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
                <hr>

                <?php 

            }
            ?>

            </div>

                <div class="loading" id="loading">
                    Loading More
                </div>
        </div>


            <div class="col-lg-4">
                <?php include("upcoming_events.php"); ?>
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
        <h4 class="modal-title" id="myModalLabel">New News Article</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="new_news_post.php" method="POST" enctype="multipart/form-data" onsubmit="return validatePostForm()">
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" name="file" id="file">
                </div>
            </div>

  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">*Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="title" name="title" value="Title">
    </div>
  </div>
  <div class="form-group">
    <label for="teaser" class="col-sm-2 control-label">Teaser</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="teaser" name="teaser" value="Teaser">
    </div>
  </div>
    <div class="form-group">
    <label for="video" class="col-sm-2 control-label">Embed Video</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="video" name="video">
    </div>
  </div>
  <div class="form-group">
    <label for="content" class="col-sm-2 control-label">Content</label>
    <div class="col-sm-10">
      <textarea id ="content" class="form-control" rows="8" name="content" style="width:600px">Content</textarea>
    </div>
  </div>

    <div id = "postValidation">
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



<script type="text/javascript" src="js/scrollpagination.js"></script>
<script type="text/javascript">

function validatePostForm()
{
var title = document.getElementById("title").value;

if (title==null || title=="")
  {
  $('#postValidation').html("<div class='alert alert-danger'><p>You must enter a Title field.</p></div>").hide().fadeIn('slow');
  return false;
  }
 
}

var page = -1;
var children = $('#contents').children().size();
$('#loading').fadeOut();
$(function(){
    $('#contents').scrollPagination(
        {
        'contentPage': 'blog_home_content.php', // the url you are fetching the results
        'contentData': {'page': function() {return page}}, // these are the variables you can pass to the request, for example: children().size() to know which page you are
        'scrollTarget': $(window), // who gonna scroll? in this example, the full window
        'heightOffset': 10, // it gonna request when scroll is 10 pixels before the page ends
        'beforeLoad': function(){ // before load function, you can display a preloader div
            page ++;
            console.log(page);
            $('#loading').fadeIn(); 
        },
        'afterLoad': function(elementsLoaded){ // after loading content, you can use this function to animate your new elements
             $('#loading').fadeOut();
             var i = 0;
             $(elementsLoaded).fadeInWithDelay();
             if ($('#contents').children().size() == children){ // no more results
                 $('#contents').stopScrollPagination();
                 console.log("stopping pagination!");
            }
            else{
                children = $('#contents').children().size();
            }
        }
    });
    
    // code for fade in element by element
    $.fn.fadeInWithDelay = function(){
        var delay = 0;
        return this.each(function(){
            $(this).delay(delay).animate({opacity:1}, 200);
            delay += 100;
        });
    };
           
});
</script>


<?php 
include("wysiwyg.php");
?>

</body>

</html>
