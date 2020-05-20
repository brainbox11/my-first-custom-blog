<?php 
	require_once 'inc/top.php';

	if (isset($_POST['add_post'])) {
			$catdrop = mysql_entities_fix_string($conn, $_POST['cat-drop']);
			$p_title = mysql_entities_fix_string($conn, $_POST['p_title']);
			$p_write = mysql_entities_fix_string($conn, $_POST['p_write']);
			$location = "img";
			//$file = $_FILES['p_file'];
			$p_user = $_SESSION['uid'];
			if ($_FILES['pfile']['tmp_name']) {
				$file = $_FILES['pfile'];
				if (!$file['tmp_name']) {
					header("Location: index.php?s=error");
					exit();
				}

				$location = "photo/Upload/";
				require_once 'inc/img.php';
				$fileNameNew = "TL".$fileNameNew;
				$location = "$fileNameNew";

			}
			$sql2 = "INSERT INTO post ( author , description, time, title, category, image) VALUES ('$p_user', '$p_write', SYSDATE(), '$p_title', '$catdrop', '$location');";
			$result= mysqli_query($conn, $sql2);

			$alert="Your Post was Successful!";

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
					<h1 class="head"><i class=" fa fa-file"></i> Add Post <small>New Post</small></h1>
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-tachometer"></i> Dashboard</li>
					</ol>
					<?php 
					if (isset($alert)) {
			          echo '<div class="alert alert-danger alert-dismissible" role="alert">
			                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                <strong>'.$alert.'</strong>
			              </div>';
			        } ?>
					<form action="addPost.php" method="POST"  enctype="multipart/form-data">
				      <div class="form-horizontal">
				      	<div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label"><strong>Select Category</strong> <i class=" fa fa-folder-open"></i></label>
					    <div class="col-sm-10">
					      <select class="form-control" name="cat-drop">
					       
					      		<?php 
					      			$sql = "SELECT * FROM categories ORDER BY category ASC";
									$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
										
										while ($row = mysqli_fetch_assoc($result)) {
											$group = $row['category'];
											
											echo "<option value='$group'>$group</option>";
											
										}
									} else {
										echo "<option value=''>No Category Yet</option>";
									}
					       
					      		 ?>
							</select>
					    </div>
						</div>
						<div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label"><strong>Post Title</strong></label>
						    <div class="col-sm-10">
						      <input type="text" name="p_title" class="form-control" id="inputEmail3" placeholder="Post title..." required="">
						    </div>
						  </div><hr>
						<textarea name="p_write" class="form-control" rows="6" placeholder="Write Post..." required=""></textarea>
				      </div>
				        <hr>
				        <div class="form-group">
						    <label for="exampleInputFile"><strong>Attach Photo</strong></label>
						    <input type="file" name="pfile" id="exampleInputFile" required>
				      </div>
				      <button name="add_post" value="add_post" type="submit" class="btn btn-primary btn-block">POST</button>
				      </div>
			      </form>
				</div>
			</div>
		</div>
		<?php require_once 'inc/footer.php'; ?>
	</div>
</body>
</html>