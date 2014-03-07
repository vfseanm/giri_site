<?php
include('globals.php');
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

            <div class="col-lg-12">
                <h1 class="page-header">GIRI Events
                </h1>
            </div>

        </div>

        <div class="row">

            <div class="col-md-5">
                <a href="blog-post.html">
                    <img src="http://placehold.it/600x300" class="img-responsive">
                </a>
            </div>
            <div class="col-md-7">
                <h3><a href="blog-post.html">An Upcoming Conference</a>
                </h3>
                <p><b>03/30/2014</b></p>
                </p>
                <p>This is a very basic starter template for a blog homepage. It makes use of Font Awesome icons that are built into the 'Modern Business' template, and it makes use of the Bootstrap 3 pager at the bottom of the page.</p>
                <a class="btn btn-primary" href="blog-post.html">Read More <i class="fa fa-angle-right"></i></a>
            </div>

        </div>

        <hr>

        <div class="row">
            <div class="col-md-5">
                <a href="blog-post.html">
                    <img src="http://placehold.it/600x300" class="img-responsive">
                </a>
            </div>
            <div class="col-md-7">
                <h3><a href="blog-post.html">Another Upcoming Conference</a>
                </h3>
                <p><b>04/30/2014</b></p>
                </p>
                <p>This is a very basic starter template for a blog homepage. It makes use of Font Awesome icons that are built into the 'Modern Business' template, and it makes use of the Bootstrap 3 pager at the bottom of the page.</p>
                <a class="btn btn-primary" href="blog-post.html">Read More <i class="fa fa-angle-right"></i></a>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-5">
                <a href="blog-post.html">
                    <img src="http://placehold.it/600x300" class="img-responsive">
                </a>
            </div>
            <div class="col-md-7">
                <h3><a href="blog-post.html">Special Event</a>
                </h3>
                <p><b>05/30/2014</b></p>
                </p>
                <p>This is a very basic starter template for a blog homepage. It makes use of Font Awesome icons that are built into the 'Modern Business' template, and it makes use of the Bootstrap 3 pager at the bottom of the page.</p>
                <a class="btn btn-primary" href="blog-post.html">Read More <i class="fa fa-angle-right"></i></a>
            </div>
        </div>

        <hr>

        <div class="row">

            <ul class="pager">
                <li class="previous"><a href="#">&larr; Older</a>
                </li>
                <li class="next"><a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

    </div>
           <?php
    include('footer.php');
    ?>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

</body>

</html>
