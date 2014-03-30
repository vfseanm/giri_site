<?php
include('globals.php');

	$searchResults = array();
	$original_search = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$search = $_POST["searchInput"];
	$original_search = $search;
	$search = strtoupper($search);
	$search = strip_tags($search);
	$search = trim($search);
	$search = "%".$search."%";

	$searchResults = array();

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


// find posts by title
$result = mysqli_query($con, "SELECT * FROM post WHERE upper(title) LIKE '$search'");

while($row = mysqli_fetch_array($result))
  {
  	$item = array();
  	$item[0] =  stripslashes($row['title']);
  	$item[1] = stripslashes($row['content']);
  	$item[2] = $row['image'];
  	$item[3] = $row['id'];
  	$item[4] = stripslashes($row['teaser']);
  	$item[5] = "";
  	$item[6] = "";
  	$searchResults[$row['id']] = $item;
  }
  mysqli_free_result($result);


// find events by title
  $result = mysqli_query($con, "SELECT * FROM events WHERE upper(name) LIKE '$search'");

while($row = mysqli_fetch_array($result))
  {
  	$item = array();
  	$item[0] =  stripslashes($row['name']);
  	$item[1] = stripslashes($row['description']);
  	$item[2] = $row['image'];
  	$item[3] = $row['id'];
  	$item[4] = stripslashes($row['teaser']);
  	$item[5] = $row['startdate'];
  	$item[6] = $row['enddate'];
  	$searchResults[$row['id']] = $item;
  }
  mysqli_free_result($result);


// find posts by teaser
  $result = mysqli_query($con, "SELECT * FROM post WHERE upper(teaser) LIKE '$search'");

while($row = mysqli_fetch_array($result))
  {
  	$item = array();
  	$item[0] =  stripslashes($row['title']);
  	$item[1] = stripslashes($row['content']);
  	$item[2] = $row['image'];
  	$item[3] = $row['id'];
  	$item[4] = stripslashes($row['teaser']);
  	$item[5] = "";
  	$item[6] = "";
  	$searchResults[$row['id']] = $item;
  }

  mysqli_free_result($result);


  // find events by teaser
  $result = mysqli_query($con, "SELECT * FROM events WHERE upper(teaser) LIKE '$search'");

while($row = mysqli_fetch_array($result))
  {
  	$item = array();
  	$item[0] =  stripslashes($row['name']);
  	$item[1] = stripslashes($row['description']);
  	$item[2] = $row['image'];
  	$item[3] = $row['id'];
  	$item[4] = stripslashes($row['teaser']);
  	$item[5] = $row['startdate'];
  	$item[6] = $row['enddate'];
  	$searchResults[$row['id']] = $item;
  }
  mysqli_free_result($result);


  // find posts by content
  $result = mysqli_query($con, "SELECT * FROM post WHERE upper(content) LIKE '$search'");

while($row = mysqli_fetch_array($result))
  {
  	$item = array();
  	$item[0] =  stripslashes($row['title']);
  	$item[1] = stripslashes($row['content']);
  	$item[2] = $row['image'];
  	$item[3] = $row['id'];
  	$item[4] = stripslashes($row['teaser']);
  	$item[5] = "";
  	$item[6] = "";
  	$searchResults[$row['id']] = $item;
  }

  mysqli_free_result($result);


    // find events by content
  $result = mysqli_query($con, "SELECT * FROM events WHERE upper(description) LIKE '$search'");

while($row = mysqli_fetch_array($result))
  {
  	$item = array();
  	$item[0] =  stripslashes($row['name']);
  	$item[1] = stripslashes($row['description']);
  	$item[2] = $row['image'];
  	$item[3] = $row['id'];
  	$item[4] = stripslashes($row['teaser']);
  	$item[5] = $row['startdate'];
  	$item[6] = $row['enddate'];
  	$searchResults[$row['id']] = $item;
  }
  mysqli_free_result($result);


mysqli_close($con);

$searchResults = array_slice($searchResults, 0, 15);


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Search Result - GIRI</title>

    <?php 
    include('header_links.php');
    ?>
</head>

<body>

    <?php
    include("navbar.php");
    ?>

    <div class="container" style="min-height:100%; margin-bottom:-205px; height:auto">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Search Results
            <?php 
                check_for_error();
            ?>
                </h1>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">
                <div id="contents">
                	<?php if (count($searchResults)==0) { ?>
                	<h4>Sorry! No results for your search.</h4>
                	<p>You searched: <b><?php echo $original_search; ?></b></p>

                	<?php } ?>

                <?php 
                foreach($searchResults as $post){
                    ?>    
                    <div class="row" style="margin-bottom:15px">
                    
                    
                <div class="col-lg-4"> 
                    <?php 
                    if(strcmp($post[5], "")==0){  // it is an article ?>
                       <a href="post.php?ID=<?php echo $post[3] ?>">
                		<?php if ($post[2] == ""){  // no image ?>
                			<img src="/upload/globe.png" class="img-responsive">
                		<?php } 
                		else { ?>
                    		<img src="/upload/<?php echo $post[2] ?>" class="img-responsive">
                    	<?php } echo '</a>'; }
                    else{  // it is an event ?>
                    	<a href="/events/event.php?ID=<?php echo $post[3] ?>">
                    	<?php if ($post[2] == ""){  // no image ?>
                        	<img src="/events/default_event.png" class="img-responsive main">
                        <?php }
                        else { ?>
                        <img src="/upload/<?php echo $post[2] ?>" class="img-responsive">
						<?php } echo '</a>'; } ?>

            </div>
                
            <div class="col-lg-8">
                <h3 style="margin-top:0px"><a href="post.php?ID=<?php echo $post[3] ?>"><?php echo $post[0] ?></a>
                </h3>
                <?php if(strcmp($post[5], "")!=0){ ?>
                <p class = "startdate">From: <b><?php echo $post[5] ?></b> to <b><?php echo $post[6] ?></b> </p>
                <?php } ?>
                <p><?php echo $post[4] ?>
                </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12"> 
                <a class="btn btn-success" href="post.php?ID=<?php echo $post[3] ?>">Read More <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
                <hr>

                <?php 

            }
            ?>

            </div>

        </div>


            <div class="col-lg-4">
                <?php include("upcoming_events.php"); ?>
            </div>
        </div>
        <div style="height:205px">
        </div>

    </div>
    <!-- /.container -->



        <?php
    include('footer.php');
    ?>

    </body>

</html>
