<?php 
	require_once 'inc/top.php';

	if (isset($_POST['change'])) {
		$pic = $_SESSION['uid'];
	 	$file = $_FILES['file'];
	 	if (isset($file['tmp_name'])) {
	 		$location = "photo/profile/";
			//$img_name = img_resize_upload($file,$location);
			require_once 'inc/img.php';
			$fileNameNew = "TL".$fileNameNew;
			$location = $fileNameNew;
			$sql = "UPDATE users SET Profile='$location' WHERE id='$pic';";
			$result= mysqli_query($conn, $sql);
			if (!$result) {
				echo "Error! in Profile update";
				exit();
			}
 		}
 	}
 ?>
<body>
	<div id="wrapper">
		<?php require_once 'inc/header.php'; ?>

		<div class="container-fluid body-section">
			<div class="row">
				<div class="col-md-3">
					<?php require_once 'inc/sidebar.php'; ?>
				</div>
				<div class="col-md-9">
					<h1 class="head"><i class=" fa fa-user"></i> User Profile <small>User Manager</small></h1>
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-tachometer"></i> Dashboard</li>
					</ol>
					<?php 

					$u = $_SESSION['uid'];
					$e = $_SESSION['email'];

					$sql5 = "SELECT author, profile FROM users WHERE id='$u'";
					$result5 = mysqli_query($conn, $sql5);
					if (!$result5) {
					  echo "<h1>Error!</h1>";
					  exit();
					}
					$row5 = mysqli_fetch_assoc($result5);
					$u = $row5['author'];
					$pro = $row5['profile'];
					$pro2 = "photo/Thumb/thumb_".$pro;
					  if ($pro == "img") {
					      $pro2 = "assets/Gift.jpg";
					  }
					 ?>
					<div class="container-fluid">
	                   <div class="row">
	                     <div class="col-sm-3">
	                      <a href='#'>
	                       <img class="img-responsive img-rounded" src="<?php echo $pro2 ?>">
	                      </a>
	                     </div>
	                     <div class='col-sm-9'><hr>
	                        <form class="form-horizontal" action='profile.php' method='POST' enctype="multipart/form-data">
	                        <div class="form-group">
	                          <label class="col-sm-4 control-label"><strong>Username:</strong></label>
	                          <div class="col-sm-8">
	                            <p class="form-control-static"><?php echo $u; ?></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-4 control-label"><strong>Role:</strong></label>
	                          <div class="col-sm-8">
	                            <p class="form-control-static">Admin</p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-4 control-label"><strong>Email:</strong></label>
	                          <div class="col-sm-8">
	                            <p class="form-control-static"><?php echo $e; ?></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label for="inputfile" class="col-sm-4 control-label"><strong>Change photo:</strong></label>
	                          <div class="col-sm-8">
	                            <input type="file" name="file" class="form-control-static" id="inputfile" required>
	                          </div>
	                        </div>
	                        <div class="modal-footer">
	                          <button type="sumbit" name="change" value='change' class="btn btn-primary">Save changes</button>
	                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                        </div>
	                      </form>
	                     </div>
	                 </div>
	                </div>
				</div><!--end-->
			</div>
		</div>
		<?php require_once 'inc/footer.php'; ?>
	</div>
</body>
</html>