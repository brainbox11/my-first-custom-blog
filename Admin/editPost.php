<?php 
	require_once 'inc/top.php';


if (isset($_POST['update'])) {
	$p_up = $_POST['p_up'];
	$title = $_POST['title'];
	$post = $_POST['post'];

	$sql = "UPDATE post SET title='$title' WHERE id='$p_up';";
	$result= mysqli_query($conn, $sql);
	if (!$result) {
		echo "Error! in title update";
		exit();
	}
	$sql = "UPDATE post SET description='$post' WHERE id='$p_up';";
	$result= mysqli_query($conn, $sql);
	if (!$result) {
		echo "Error! in Message update";
		exit();
	}
	header("Location: post.php?done=1");
	exit();
}
 ?>
<body>
	<div id="wrapper">
		<?php require_once 'inc/header.php'; ?>

		<div class="container-fluid body-section">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<h1 class="head"><i class=" fa fa-tachometer"></i> Edit Post </h1>
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-tachometer"></i> Dashboard</li>
					</ol>
					<?php 
					if (isset($_GET['edit'])) {
						$p_id = $_GET['pid'];
						$query = "SELECT title, description FROM post WHERE id=$p_id";
						$run = mysqli_query($conn, $query);
						$row = mysqli_fetch_assoc($run);
					}
					?>
					<form class="form-horizontal" action="" method="POST">
							<input type="hidden" name="p_up" value="<?php echo $p_id; ?>">
						  <div class="form-group">
						    <label for="input3" class="col-sm-2 control-label"><b>Post title</b></label>
						    <div class="col-sm-10">
						      <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" id="input3" placeholder="Title" required>
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 control-label"><b>Post</b></label>
						    <div class="col-sm-10">
						      <textarea class="form-control" name="post" rows="12" required><?php echo $row['description']; ?></textarea>
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      <button name="update" type="submit" class="btn btn-default">Update</button>
						    </div>
						  </div>
						</form>
					
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
		<footer class="text-center fixed-bottom">
			Copyright &copy;by <a href="#" >ALPHA</a> from 2017-xxxx
		</footer>
	</div>
</body>
</html>