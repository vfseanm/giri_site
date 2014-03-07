<?php

$con=mysqli_connect("localhost", "admin", "password", "giri");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con, "SELECT * FROM footer WHERE id=1");

while($row = mysqli_fetch_array($result))
  {
    $address_one = $row['address_one'];
    $address_two = $row['address_two'];
    $address_three = $row['address_three'];
    $phone = $row['phone'];
}
mysqli_close($con);

?>

<div id="footer" style="background-color: #f5f5f5; height:auto">
      <div class="container" style="padding-top:15px">
        <div class="row">
          <div class="col-lg-4 col-md-4">
          <address>
            <i class="fa fa-envelope"></i><strong> <?php echo $address_one ?></strong><br>
              <?php echo $address_two ?><br>
              <?php echo $address_three ?><br>
          </address>
          <p><i class="fa fa-phone"></i> <?php echo $phone ?></p>
        </div>
        <div class="col-lg-4 col-md-4">
          <strong>Quick Links</strong><br>
          <a href="people.php">People</a><br>
          <a href="about.php">About GIRI</a><br>
          <a href="blog_home.php">News</a>
        </div>
        <div class="col-lg-4 col-md-4">
          <p><strong>Other Stuff</strong></p>
          <p><i class="fa fa-facebook-square"></i> Maybe a Facebook Button</p>

        <?php if (!loggedin()){ ?>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
 			 Manage Site
		</button>
		<?php }
		else {?>
		<a href="logout.php" class="btn btn-primary btn-sm">
 			 Logout
		</a>
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#footerModal">
             Edit Footer
        </button>
	<?php } ?>
</div>
</div>
      </div>
    </div>


<!-- **********************Modal************************** -->

<div class="modal fade" id="footerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Footer</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="edit_footer.php" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="address_one" class="col-sm-2 control-label">Address Line 1</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="address_one" name="address_one" value="<?php echo $address_one ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="address_two" class="col-sm-2 control-label">Address Line 2</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="address_two" name="address_two" value="<?php echo $address_two ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="address_three" class="col-sm-2 control-label">Address Line 3</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="address_three" name="address_three" value="<?php echo $address_three ?>">
    </div>
  </div>

    <div class="form-group">
    <label for="phone" class="col-sm-2 control-label">Phone #</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone ?>">
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





<!-- Admin Login Modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Login as Site Administrator</h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" role="form" action="authenticate.php" method="POST">
  <div class="form-group">
    <label for="username" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" placeholder="Username" name="username">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" placeholder="Password" name="password">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
  </div>
</form>

      </div>
    </div>
  </div>
</div>