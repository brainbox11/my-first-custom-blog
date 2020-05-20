<?php require_once 'inc/top.php'; ?>
<body>
<?php require_once 'inc/header.php'; ?>
<?php 
	
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
 ?>
<div class="jumbotron">
	<div class="container">
		<div id="detail" class="animated fadeInLeft">
			<h1>Babar786 <span>Blog</span></h1>
			<p>Insight awaits in your mind. Bring them into focus with SPLENDOR!</p>
		</div>
	</div>
	<img src="assets/jumbotron.jpg" alt="Top-image">
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<!--Code for carousel-->
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				    <div class="item active">
				      <img src="assets/Slider_1.jpg" alt="Slider 1">
				      <div class="carousel-caption">
				        <h4>This is the heading of Slider 1</h4>
				      </div>
				    </div>
				    <div class="item">
				      <img src="assets/Slider_2.jpg" alt="Slider 2">
				      <div class="carousel-caption">
				        <h4>This is the heading of Slider 2</h4>
				      </div>
				    </div>
				    <div class="item">
				      <img src="assets/Slider_3.jpg" alt="Slider 3">
				      <div class="carousel-caption">
				        <h4>This is the heading of Slider 3</h4>
				      </div>
				    </div>
				  </div>

				  <!-- Controls -->
				  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div><!--End of carousel-->
				<!--Code for Posts-->
				<?php
				if (isset($_POST['search'])) {
					$search = mysql_entities_fix_string($conn, $_POST['search-title']);
					$sql = "SELECT id, image, DATE_FORMAT(time, '%h:%i %p %b %D %Y'), YEAR(time), DAY(time), MONTHNAME(time),title, LEFT(description,'250'), category, author FROM post";
					$sql .= " WHERE MATCH(title) AGAINST('$search' IN BOOLEAN MODE)";
					$sql .= " ORDER BY time DESC LIMIT $post_start_from, $num_of_post";
				} else {
					$sql = "SELECT id, image, DATE_FORMAT(time, '%h:%i %p %b %D %Y'), YEAR(time), DAY(time), MONTHNAME(time),title, LEFT(description,'250'), category, author FROM post";
					if (isset($cat_name)) {
						$sql .= " WHERE category = '$cat_name'";
					}
					$sql .= " ORDER BY time DESC LIMIT $post_start_from, $num_of_post";
				}
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
					$p_id = $row['id'];
					$username = $row['author'];
					$p_message = $row["LEFT(description,'250')"];
					$p_title = $row['title'];
					$p_cate = $row['category'];
					$p_day = $row["DAY(time)"];
					$p_month = $row["MONTHNAME(time)"];;
					$p_year = $row["YEAR(time)"];;
					$p_imgname = $row['image'];
					$path = "admin/photo/Upload/".$p_imgname;

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
						$pro2 = "admin/photo/Thumb/thumb_".$pro;
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
						<a href="post.php?post_id=$p_id"><img class="img-responsive" src="$path" alt="Post Image"></a>
						<p class="desc">$p_message</p>
						<a href="post.php?post_id=$p_id" class="btn btn-primary">Read more...</a>
						<div class="bottom">
							<span class="first"><i class="fa fa-folder"></i><a href=""> $p_cate</a></span>|
							<span class="sec"><i class="fa fa-comment"></i><a href="post.php?post_id=$p_id"> Comment</a></span>
						</div>
					</div>
__END;
					}
				} else {
					echo "<h2>No Post avaliable</h2>";
				}
				
				?>
				<!--End of Post 1-->
				

				<nav id="pagination">
				  <ul class="pagination">
				  	<?php 
				  		for ($i=1; $i <= $total_pages; $i++) { 
				  			echo "<li class='".($page_id == $i ? 'active' : '')."'><a href='index.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":"")."'>$i</a></li>";
				  		}
				  	 ?>
				  	<!--
				    <li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
				    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
				    <li><a href="#">2</a></li>
				    <li><a href="#">3</a></li>
				    <li><a href="#">4</a></li>
				    <li><a href="#">5</a></li>
				    <li>
				      <a href="#" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				      </a>
				    </li>-->
				  </ul>
				</nav>
			</div>
			<!--Code for sidebar-->
			<div class="col-md-4">
				<?php require_once 'inc/sidebar.php'; ?>
			</div>
		</div>
	</div>
</section>
<?php require_once 'inc/footer.php'; ?>
</body>
</html>