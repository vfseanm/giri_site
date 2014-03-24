<?php
include('globals.php');

$postid =$_GET["ID"];

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM post WHERE id='$postid'");

while($row = mysqli_fetch_array($result))
  {
    $title = $row['title'];
    $title = stripslashes($title);
    $content = $row['content'];
    $content = stripslashes($content);
    $image = $row['image'];
    $timestamp = $row['time_created'];
    $teaser = $row['teaser'];
    $teaser = stripslashes($teaser);
    $embed_code = $row['embed_code'];
    $embed_code = stripslashes($embed_code);
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

    <title>Blog or News Post</title>

    <!-- Bootstrap core CSS -->

    
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>


    <!-- Add custom CSS here -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet">

        <?php 
    include('header_links.php');
    ?>

</head>

<body>

<?php
include('navbar.php');
?>

    <div class="container">
        <div class="row">


            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $title ?>
            <?php 
                check_for_error();
                ?>
                    <?php
        if (loggedin()){
            ?>
                <a href="#" data-toggle="modal" data-target="#postModal" style="font-size:24px;padding-left:20px">
                <i class="fa fa-pencil"></i>edit</a>
                <form id="delete_form" class="form-horizontal" role="form" action="delete_post.php?ID=<?php echo $postid ?>" method="POST" enctype="multipart/form-data" style="display:inline" onsubmit="return confirmDelete()">
                <a href="#" onclick="document.getElementById('delete_form').submit()" id = "delete" class="red" style="font-size:24px;padding-left:20px">
                <i class="fa fa-times"></i>delete</a>
            </form>
        <?php
        }
        ?>
                </h1>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">

                <p><i class="fa fa-clock-o"></i> Posted on <?php echo date('F d, Y', $timestamp) ?>
                </p>
                <hr>
                <div style="padding-bottom:15px">
                <div style="text-align:center">
                <?php 
                if ($embed_code != ""){
                    echo $embed_code;
                 } ?>
             </div>
                <?php 
                if ($image != ""){
                ?>
                <img src="<?php echo 'upload/' . $image ?>" class="img-responsive">
                <?php } ?>
                <?php if (loggedin() && strcmp($image, "")!=0){ ?>
                    <a class="red" href="post_delete_image.php?ID=<?php echo $postid ?>"><i class="fa fa-times"></i>Delete Image</a>
                  <?php } ?>
            </div>
                
                <?php echo $content ?>

            </div>

            <div class="col-lg-4">
                <?php include("upcoming_events.php"); ?>
            </div>
        </div>

    </div>
    
    <br />
    <br />
    <br />

        <?php
    include('footer.php');
    ?>


    <!-- **********************Modal************************** -->

<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Post</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="edit_post.php?ID=<?php echo $postid ?>" method="POST" enctype="multipart/form-data" onsubmit="return validatePostForm()">
             <div class="form-group">
                <label for="curfile" class="col-sm-2 control-label">Current Image</label>
                <div class="col-sm-10" id="curfile">
                    <?php if (strcmp($image, "")!=0){
                    echo $image; ?>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Change Image</label>
                <div class="col-sm-10">
                    <input type="file" name="file" id="file">
                </div>
            </div>

  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">*Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="title" name="title" value="<?php echo $title ?>">
    </div>
  </div>
    <div class="form-group">
    <label for="teaser" class="col-sm-2 control-label">Teaser (optional)</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="teaser" name="teaser" value="<?php echo $teaser ?>">
    </div>
  </div>
      <div class="form-group">
    <label for="video" class="col-sm-2 control-label">Embed Video (optional)</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="video" name="video" value='<?php echo $embed_code ?>'>
    </div>
  </div>
  <div class="form-group">
    <label for="content" class="col-sm-2 control-label">Content</label>
    <div class="col-sm-10">
      <textarea id ="summernote" class="textarea summernote" rows="8" name="content" style="width:600px"><?php echo $content ?></textarea>
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



    <!-- JavaScript -->

    <script type="text/javascript">

function confirmDelete(){
    console.log("deleting");
            var x = confirm("Are you sure you want to delete this article?");
            if (x==true) { // do nothing  
            }
            else
            { 
                return false; //stop the delete
            }
        }


function validatePostForm()
{
var title = document.getElementById("title").value;

if (title==null || title=="")
  {
  $('#postValidation').html("<div class='alert alert-danger'><p>You must enter a Title field.</p></div>").hide().fadeIn('slow');
  return false;
  }
 
}

    </script>

<?php 
include("wysiwyg.php");
?>

 
</body>

</html>
