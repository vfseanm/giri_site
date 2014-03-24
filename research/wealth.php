<?php
include('../globals.php');

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM research WHERE type='wealth' ORDER BY publishdate DESC LIMIT 10");

$articles = array();

while($row = mysqli_fetch_array($result))
  {
    $article = array();
    $article[0] = $row['title'];
    $article[1] = $row['publishdate'];
    $article[2] = $row['location'];
    $article[3] = $row['authors'];
    $article[4] = $row['summary'];
    $article[5] = $row['document'];
    $article[6] = $row['id'];
    $articles[] = $article;
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

    <title>Research - Events</title>

    <?php 
    include('../header_links.php');
    ?>
    <link href="/css/datepicker.css" rel="stylesheet">
</head>

<body>

    <?php
    include("../navbar.php");
    ?>

    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Research
                    <small>Wealth</small>
                     <?php
                      if (loggedin()){
                          ?>
                              <a href="#" data-toggle="modal" data-target="#addResearchModal" style="font-size:18px">
                              <i class="fa fa-plus"></i> New Article
                              </a>
                      <?php
                      }
                      ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/index.php">GIRI</a>
                    </li>
                    <li>Research</li>
                    <li class="active">Wealth</li>
                </ol>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-12">

                <div class="panel-group" id="accordion">
                  <div id="contents">
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
                      </div>
                      <div class="loading" id="loading">
                    Loading More
                </div> 
                </div>
            </div>

        </div>

    </div>
    <!-- /footer -->
    <?php
    include('../footer.php');
    ?>
    <!-- /.footer -->

        <!-- ********************** Edit Modal************************** -->

<div class="modal fade" id="editResearchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button id = "closeEditModal" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit article</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" id = "editform" action="edit_research.php?ID=<?php echo $article[6]?>" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="curfile" class="col-sm-2 control-label">Current document</label>
                <div class="col-sm-10" id="curfile">

                </div>
            </div>
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Upload document</label>
                <div class="col-sm-10">
                    <input type="file" name="file" id="document">
                </div>
            </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title" value="">
                </div>
              </div>

            <div class="form-group">
              <label for="headline" class="col-sm-2 control-label">Publish date</label>
              <div class="col-sm-10">
                <input type="text" class="span2" value="" id="dp" name="date" data-date-format="yyyy-mm-dd">
              </div>
            </div>

            <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="location" name="location" value="">
                </div>
              </div>

            <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Authors</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="authors" name="authors" value="">
                </div>
              </div>

              <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Summary</label>
                <div class="col-sm-10">
                  <textarea id ="editsummary" class="form-control" name="summary" value = "" style="width:600px"></textarea>
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
<!-- **********************End Edit Modal************************** -->

<!-- ********************** Add Modal************************** -->

<div class="modal fade" id="addResearchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add article</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="new_research.php?TYPE=wealth" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Upload document</label>
                <div class="col-sm-10">
                    <input type="file" name="file">
                </div>
            </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" value="">
                </div>
              </div>

            <div class="form-group">
              <label for="headline" class="col-sm-2 control-label">Publish date</label>
              <div class="col-sm-10">
                <input type="text" class="span2" value="" id="dp2" name="date" data-date-format="yyyy-mm-dd">
              </div>
            </div>

            <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="location" value="">
                </div>
              </div>

            <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Authors</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="authors" value="">
                </div>
              </div>

              <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Summary</label>
                <div class="col-sm-10">
                  <textarea id ="addsummary" class="form-control" name="summary" value = "" style="width:600px"></textarea>
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
<!-- **********************End ADD Modal************************** -->

    <!-- JavaScript -->
    <script src="/js/jquery-1.10.2.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/modern-business.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/research.js"> </script>

    <!-- JavaScript -->
    <?php 
    include("../wysiwyg.php");
    ?>
<script type="text/javascript" src="/js/scrollpagination.js"></script>
    <script type="text/javascript">
var page = -1;
var children = $('#contents').children().size();
$(function(){
    $('#contents').scrollPagination(
        {
        'contentPage': 'research_content.php', // the url you are fetching the results
        'contentData': {'page': function() {return page}, 'type': 'wealth'}, // these are the variables you can pass to the request, for example: children().size() to know which page you are
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

</body>

</html>