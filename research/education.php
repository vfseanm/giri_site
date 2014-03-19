<?php
include('../globals.php');

$con=mysqli_connect("localhost", "giri_user", "47nufkXUQIVTnGlg", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM events ORDER BY eventdate DESC LIMIT 5");

$posts = array();

while($row = mysqli_fetch_array($result))
  {
    $event = array();
    $event[0] = $row['name'];
    $event[1] = $row['eventdate'];
    $event[2] = $row['description'];
    $event[3] = $row['image'];
    $event[4] = $row['id'];
    $events[] = $event;
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
                    <small>Education</small>
                </h1>
                <?php
                if (loggedin()) {
                ?>
                    <button style = "margin-bottom:10px;" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addResearchModal">
                        Add Article
                    </button>
                <?php
                 }
                ?>
                <ol class="breadcrumb">
                    <li><a href="/index.php">GIRI</a>
                    </li>
                    <li>Research</li>
                    <li class="active">Education</li>
                </ol>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-12">

                <div class="panel-group" id="accordion">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                  <strong> The viability of Ruby on Rails in the PHP dominated environment </strong>
                                  <?php if (loggedin()){ ?>
                                  <a href="#" data-toggle="modal" data-target="#editResearchModal">
                                       <i class="fa fa-cogs" style = "color:#428bca;"></i>
                                  </a>
                                  <?php } ?>
                                </a>
                                <p style="margin-top:5px">
                                <small> 2/24/2014 | Durham, NC | Sean Miller, Dan Deng </small>
                                </p>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                            <a class="btn btn-success" href="" style="margin-left:15px;margin-bottom:10px"> View Report <i class="fa fa-angle-right"></i></a>
                        </div>
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
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit article</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="edit_research.php?ID=<?php echo $id ?>" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="curfile" class="col-sm-2 control-label">Current document</label>
                <div class="col-sm-10" id="curfile">
                    <?php echo $image ?>
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
                  <input type="text" class="form-control" id="title" name="title" value="<?php echo $title ?>">
                </div>
              </div>

            <div class="form-group">
              <label for="headline" class="col-sm-2 control-label">Date</label>
              <div class="col-sm-10">
                <input type="text" class="span2" value="<?php echo $date ?>" id="dp" name="date" data-date-format="yyyy-mm-dd">
              </div>
            </div>

            <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="location" name="location" value="<?php echo $location ?>">
                </div>
              </div>

            <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Authors</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="authors" name="authors" value="<?php echo $authors ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Summary</label>
                <div class="col-sm-10">
                  <textarea id ="editsummary" class="form-control" name="summary" value = "" style="width:600px"><?php echo $summary ?></textarea>
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

        <form class="form-horizontal" role="form" action="new_research.php?TYPE=education" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Upload document</label>
                <div class="col-sm-10">
                    <input type="file" name="file" id="document">
                </div>
            </div>

              <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" value="<?php echo $title ?>">
                </div>
              </div>

            <div class="form-group">
              <label for="headline" class="col-sm-2 control-label">Date</label>
              <div class="col-sm-10">
                <input type="text" class="span2" value="<?php echo $date ?>" id="dp2" name="date" data-date-format="yyyy-mm-dd">
              </div>
            </div>

            <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="location" value="<?php echo $location ?>">
                </div>
              </div>

            <div class="form-group">
                <label for="headline" class="col-sm-2 control-label">Authors</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="authors" value="<?php echo $authors ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="content" class="col-sm-2 control-label">Summary</label>
                <div class="col-sm-10">
                  <textarea id ="addsummary" class="form-control" name="summary" value = "" style="width:600px"><?php echo $summary ?></textarea>
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
    <?php 
    include("../wysiwyg.php");
    ?>

    <!-- JavaScript -->
    <script src="/js/jquery-1.10.2.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/modern-business.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <script>
    $(function(){
        rearrangeDate();
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();
        if(dd<10) { dd='0'+dd }
        if(mm<10) { mm='0'+mm } 
        today = yyyy+'-'+mm+'-'+dd;
        $('#date').val(today);
        $('#dp').datepicker({ dateFormat: "yyyy-mm-dd" });
        $('#dp2').datepicker({ dateFormat: "yyyy-mm-dd" });

        function rearrangeDate() {
            var dates = $('.eventdate b');
            dates.contents().each(function(i,v) {
                var date = v.textContent.split('-');
                var newDate = date[1]+'-'+date[2]+'-'+date[0];
                dates.eq(i).text(newDate);
            });
        }
    });
    </script>

</body>

</html>


