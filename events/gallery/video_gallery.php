<?php
include('../../globals.php');
$id =$_GET["ID"];

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM events WHERE id='$id'");
$row = mysqli_fetch_array($result);
$videos = json_decode($row['video_gallery']);
$name = $row['name'];
$teaser = $row['teaser'];

mysqli_close($con);
?>

<!DOCTYPE HTML>

<html lang="en">
<head>
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<meta charset="utf-8">
<title><?php echo $name ?> Video Gallery</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link href="/font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/demo.css">
<style type="text/css">
    .delete{
        display: none;
    }
    .picture:hover .delete {
       display:inherit;
    }
</style>


</head>
<body>
<div class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-fixed-top .navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/events/event.php?ID=<?php echo $id?>"><i class="fa fa-arrow-left"></i> <?php echo $name ?></a>
        </div>
        <div class="navbar-collapse collapse">
        </div>
    </div>
</div>
<div class="container">
    <h1><?php echo $name ?> Video Gallery</h1>
    <?php if (strcmp($teaser, "")!=0){ ?>
    <blockquote>
        <p><?php echo $teaser ?></p>
    </blockquote>
    <?php } ?>
    
    <br>

    <?php if (loggedin()){ ?>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
       Add Video
    </button>
    <br />
    <br />
    <?php } ?>

    <!-- The container for the video gallery -->
    <?php if (!empty($videos)){
    foreach($videos as $index => $video){ ?>
    <div class="picture" style="display:inline;">
    <ul class="youtube-videogallery" style="display:inline;"> 
        <li><a href="<?php echo $video[0]?>"><?php echo $video[1] ?></a></li>
    </ul>
    <?php if (loggedin()){ ?>
    <a href="remove_video.php?ID=<?php echo $id ?>&video=<?php echo $index ?>" style="color:red"><i class="fa fa-arrow-left"></i> Remove</a>
  <?php } ?>
  </div>
    <?php }} ?>
    
    <br>
</div>

<!-- **********************Modal************************** -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Video</h4>
      </div>
      <div class="modal-body">


<form class="form-horizontal" role="form" action="add_video.php?ID=<?php echo $id ?>" method="POST" onsubmit="return validateLoginForm()">
  <div class="form-group">
    <label for="url" class="col-sm-2 control-label">YouTube URL</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="url" placeholder="Youtube URL" name="url">
    </div>
  </div>
  <div class="form-group">
    <label for="caption" class="col-sm-2 control-label">Caption</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="caption" placeholder="Caption" name="caption">
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Add Video</button>
    </div>
  </div>
</form>

      </div>
    </div>
  </div>
</div>
<!-- **********************End Modal************************** -->

<!-- Bootstrap JS is not required, but included for the responsive demo navigation and button states -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="js/demo.js"></script>
<script src="jquery.youtubevideogallery.js"></script>
    <link rel="stylesheet" href="youtube-video-gallery.css" type="text/css"/>

<script>
    $(document).ready(function(){
    $("ul.youtube-videogallery").youtubeVideoGallery({
        'innerHeight': 315,
        'innerWidth': 560
    }  );
});
    </script>

</body> 
</html>
