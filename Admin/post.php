<?php 
	require_once 'inc/top.php';


	$num_of_post = 3;
	if (isset($_GET['page'])) {
		$page_id = mysql_entities_fix_string($conn, $_GET['page']);
	} else {
		$page_id = 1;
	}

	if (isset($_GET['cat'])) {
		$cat_id = mysql_entities_fix_string($conn, $_GET['cat']);
		$cat_query = "SELECT * FROM categories WHERE id = $cat_id";
		$cat_run = mysqli_query($conn, $cat_query);
		$cat_row = mysqli_fetch_assoc($cat_run);
		$cat_name = $cat_row['category'];
	}

	if (isset($_POST['search'])) {
		$search = mysql_entities_fix_string($conn, $_POST['search-title']);
		$all_post_query = "SELECT * FROM post";
		$all_post_query .= " WHERE MATCH(title) AGAINST('$search' IN BOOLEAN MODE)";
		$all_post_run = mysqli_query($conn, $all_post_query);
		$all_post = mysqli_num_rows($all_post_run);
		$total_pages = ceil($all_post / $num_of_post);
		$post_start_from = ($page_id - 1) * $num_of_post;
	} else {
		$all_post_query = "SELECT * FROM post";
		if (isset($cat_name)) {
			$all_post_query .= " WHERE category = '$cat_name'";
		}
		$all_post_run = mysqli_query($conn, $all_post_query);
		$all_post = mysqli_num_rows($all_post_run);
		$total_pages = ceil($all_post / $num_of_post);
		$post_start_from = ($page_id - 1) * $num_of_post;
	}

	if (isset($_GET['delete'])) {
		$del_post = $_GET['pid'];
		$delTitle = $_GET['delTitle'];
		$del_Path = $_GET['path'];

		$query = "DELETE FROM post WHERE id=$del_post";
		$run = mysqli_query($conn, $query);
		if ($run) {
			$info = "success";
			unlink($del_Path);
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
					<h1 class="head"><i class=" fa fa-file"></i> Blog <small>Manager</small></h1>
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-file"></i> Post</li>
					</ol>
					
					<div class="row">
						<div class="col-sm-9">
							<?php
							if (isset($info)) {
								echo '<div class="alert alert-warning alert-dismissible" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>The Post titled
									  <strong> '.$delTitle.'</strong> was successfully deleted... 
									</div>';
							}
							if (isset($_GET['done'])) {
								echo '<div class="alert alert-warning alert-dismissible" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Post Was successfully updated. 
									</div>';
							}

							$sql = "SELECT id, image, DATE_FORMAT(time, '%h:%i %p %b %D %Y'), YEAR(time), DAY(time), MONTHNAME(time),title, description, category, author FROM post";
							if (isset($cat_name)) {
								$sql .= " WHERE category = '$cat_name'";
							}
							$sql .= " ORDER BY time DESC LIMIT $post_start_from, $num_of_post";
							
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
								$p_id = $row['id'];
								$username = $row['author'];
								$p_message = $row['description'];
								$p_title = $row['title'];
								$p_cate = $row['category'];
								$p_day = $row["DAY(time)"];
								$p_month = $row["MONTHNAME(time)"];;
								$p_year = $row["YEAR(time)"];;
								$p_imgname = $row['image'];
								$path = "photo/Upload/".$p_imgname;

								if ($p_imgname == "") {
									$path = "post-test.jpg";
								}
								$sql5 = "SELECT Profile, author FROM users WHERE id='$username'";
								$result5 = mysqli_query($conn, $sql5);
								if (!$result5) {
									echo "<h1>Error!</h1>";
									exit();
								}
								$row5 = mysqli_fetch_assoc($result5);
								$author = $row5['author'];
								if ($row5['Profile'] != "img") {
									$pro = $row5['Profile'];
									$pro2 = "photo/Thumb/thumb_".$pro;
								} else{
									$pro = $row5['Profile'];
									$pro2 = "assets/Gift.jpg";
								}
							 
								echo <<<__END
								<div class="post">
									<div class="row">
										<div class="col-md-2 post-date">
											<div class="day">$p_day</div>
											<div class="month">$p_month</div>
											<div class="year">$p_year</div>
										</div>
										<div class="col-md-8 post-title">
											<a href="#"><h2>$p_title</h2></a>
											<p>Written by: <span>$author</span></p>
										</div>
										<div class="col-md-2 profile-picture">
											<img src="$pro2" alt="Gift" class="img-circle">
										</div>
									</div>
									<a href=""><img class="img-responsive" src="$path" alt="Post Image"></a>
									<p class="desc">$p_message</p>
									<div class="bottom">
										<span class="first"><i class="fa fa-folder"></i><a href=""> $p_cate</a></span>|
										<span class="sec first"><i class="fa fa-edit"></i><a href="editPost.php?pid=$p_id&edit=edit"> Edit</a></span>|
										<span class="sec"><i class="fa fa-remove"></i><a href="post.php?pid=$p_id&page=$page_id&delete=delete&delTitle=$p_title&path=$path"> Delete</a></span>
									</div>
								</div>
__END;
								}
							} else {
								echo "<h2>No Post avaliable</h2>";
							}
							
							?>
							<nav id="pagination">
							  <ul class="pagination">
							  	<?php 
							  		for ($i=1; $i <= $total_pages; $i++) { 
							  			echo "<li class='".($page_id == $i ? 'active' : '')."'><a href='post.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":"")."'>$i</a></li>";
							  		}
							  	 ?>
							  </ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php require_once 'inc/footer.php'; ?>
	</div>
</body>
</html>