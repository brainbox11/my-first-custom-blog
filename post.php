<?php require_once 'inc/top.php'; ?>
<body>
<!--The header section-->
<?php require_once 'inc/header.php'; ?>

<?php 
	if (isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];

		$view_query = "UPDATE `post` SET `view` = view + 1 WHERE `post`.`id` = $post_id;";
		mysqli_query($conn, $view_query);

		$query = "SELECT id, image, DATE_FORMAT(time, '%h:%i %p %b %D %Y'), YEAR(time), DAY(time), MONTHNAME(time),title, description, category, author, view FROM post WHERE id = $post_id";
		$run = mysqli_query($conn, $query);
		if (mysqli_num_rows($run) > 0) {
			$row = mysqli_fetch_assoc($run);
			$id = $row['id'];
			$day = $row['DAY(time)'];
			$month = $row['MONTHNAME(time)'];
			$year = $row['YEAR(time)'];
			$title = $row['title'];
			$desc = $row['description'];
			$au = $row['author'];
			$category = $row['category'];
			$view = $row['view'];
			$img = $row['image'];
			$path = "Admin/photo/Upload/".$img;
			$vis = "";
			if ($img == "img") {
				$vis = "display: none;";
			}

			$sql5 = "SELECT Profile, author FROM users WHERE id='$au'";
			$result5 = mysqli_query($conn, $sql5);
			if (!$result5) {
				echo "<h1>Error!</h1>";
				exit();
			}
			$row5 = mysqli_fetch_assoc($result5);
			$author = $row5['author'];
			if ($row5['Profile'] != "img") {
				$pro = $row5['Profile'];
				$pro2 = "Admin/photo/Thumb/thumb_".$pro;
			} else{
				$pro = $row5['Profile'];
				$pro2 = "assets/Gift.jpg";
			}
		} else {
			header("Location: index.php?error1");
		}
	} else {
			header("Location: index.php?error2");
	}
 ?>

<div class="jumbotron">
	<div class="container">
		<div id="detail" class="animated fadeInLeft">
			<h1>Custom <span>Post</span></h1>
			<p>We are available 24x7. So Feel Free to Contact Us.</p>
		</div>
	</div>
	<img src="assets/jumbotron.jpg" alt="Top-image">
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="post">
					<div class="row">
						<div class="col-md-2 post-date">
							<div class="day"><?php echo $day; ?></div>
							<div class="month"><?php echo $month; ?></div>
							<div class="year"><?php echo $year; ?></div>
						</div>
						<div class="col-md-8 post-title">
							<a href="#"><h2><?php echo $title; ?></h2></a>
							<p>Written by: <span><?php echo $author; ?></span></p>
						</div>
						<div class="col-md-2 profile-picture">
							<img src="<?php echo $pro2; ?>" alt="Gift" class="img-circle">
						</div>
					</div>
					<a style="<?php echo $vis; ?>" href=""><img class="img-responsive" src="<?php echo $path; ?>" alt="Post Image"></a>
					<p class="desc"><?php echo $desc; ?></p>
					<div class="bottom">
						<span class="first"><i class="fa fa-folder"></i><a href=""> <?php echo $category; ?></a></span>|
						<span class="sec"><i class="fa fa-comment"></i><a href=""> Comment</a></span>|
						<span class="sec"><i class="fa fa-eye"></i><a href="#"> <?php echo $row['view']; ?></a></span>
					</div>
				</div>
				
				<div class="related-posts">
					<h3>Related Posts</h3><hr>
					<div class="row">
						<?php 
						$r_query = "SELECT * FROM post WHERE title LIKE '%$title%' LIMIT 3";
						$r_run = mysqli_query($conn, $r_query);
						while ($r_row = mysqli_fetch_assoc($r_run)) {
							$r_id = $r_row['id'];
							$r_title = $r_row['title'];
							$r_image = $r_row['image'];
							$path = "Admin/photo/Upload/".$r_image;
							$vis = "";
							if ($r_image == "img") {
								$vis = "display: none;";
							}
						 ?>
						<div class="col-sm-4">
							<a href="post.php?post_id=<?php echo $r_id; ?>">
								<img style="<?php echo $vis; ?>" src="<?php echo $path; ?>" alt="Slider 1">
								<h4><?php echo $r_title; ?></h4>
							</a>
						</div>
						<?php } ?>
					</div>
				</div>

				<div class="author">
					<div class="row">
						<div class="col-sm-3">
							<img class="img-circle" src="<?php echo $pro2; ?>" alt="Gift">
						</div>
						<div class="col-sm-9">
							<h4><?php echo ucfirst($author); ?></h4>
							<p>
								Know more about transport and Logistics, and lastest developments in transport Technology...
								<i class="fa fa-plane"></i>
							</p>
						</div>
					</div>
				</div>

				<?php 
				if (isset($_POST['submit'])) {
					$cs_name = mysql_entities_fix_string($conn, $_POST['name']);
					$cs_email = mysql_entities_fix_string($conn, $_POST['email']);
					$cs_website = mysql_entities_fix_string($conn, $_POST['website']);
					$cs_comment = mysql_entities_fix_string($conn, $_POST['comment']);
					if (empty($cs_name) or empty($cs_email) or empty($cs_website) or empty($cs_comment)) {
						$error_msg = "All (*) fields are Required";
					} else {
						$cs_query = "INSERT INTO `comments` (`id`, `date`, `name`, `post_id`, `email`, `website`, `comment`) VALUES (NULL, SYSDATE(), '$cs_name', '$post_id', '$cs_email', '$cs_website', '$cs_comment');";
						if (mysqli_query($conn, $cs_query)) {
							$msg = "Comment has been Submitted";
							$cs_name = "";
							$cs_email = "";
							$cs_website = "";
							$cs_comment = "";
						} else {
							$error_msg = "Comment has not been submitted";
						}
					}

				}
				 ?>

				<div class="comment">
					<h3>Comments</h3><hr>
					<?php 
					$cs_query = " SELECT * FROM comments WHERE post_id=$post_id ORDER BY date DESC";
					$cs_run = mysqli_query($conn, $cs_query);
					if (mysqli_num_rows($cs_run) > 0) {
						while ( $cs_row = mysqli_fetch_assoc($cs_run)) {
							
					
					 ?>
					<div class="row single-comment">
						<div class="col-sm-2">
							<img class="img-circle" src="assets/Gift.jpg" alt="Gift">
						</div>
						<div class="col-sm-10">
							<h4><?php echo $cs_row['name']; ?></h4>
							<p>
								<?php echo $cs_row['comment']; ?> 
							</p>
						</div>
					</div>
					<?php 
						}
					} else {
						echo "<h4><i class='fa fa-commenting'></i> No comment yet.</h4>";
					}
					 ?>
				</div>

				<div class="comment-box">
					<div class="row">
						<div class="col-xs-12">
							<form action="" method="POST">
								<div class="form-group">
								<label for="full-name">Full Name:*</label>
								<input type="text" name="name" value="<?php if (isset($cs_name)) echo $cs_name; ?>" id="full-name" class="form-control" placeholder="Full Name">
							</div>
							<div class="form-group">
								<label for="email">Email Address:*</label>
								<input type="text" name="email" value="<?php if (isset($cs_email)) echo $cs_email; ?>" id="email" class="form-control" placeholder="Email">
							</div>
							<div class="form-group">
								<label for="website">Website:*</label>
								<input type="text" name="website" value="<?php if (isset($cs_website)) echo $cs_website; ?>" id="website" class="form-control" placeholder="Website">
							</div>
							<div class="form-group">
								<label for="comment">Comment:*</label>
								<textarea id="comment" rows="10" cols="30" class="form-control" name="comment" placeholder="Your comment should be here."><?php if (isset($cs_comment)) echo $cs_comment; ?></textarea>
							</div>
							<input type="submit" name="submit" value="Submit Comment" class="btn btn-primary">
							<?php 
							if (isset($error_msg)) {
								echo "<span style='color: red;' class='pull-right'>$error_msg</span>";
							} elseif (isset($msg)) {
								echo "<span style='color: green;' class='pull-right'>$msg</span>";
							}
							 ?>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--Code for sidebar-->
			<div class="col-md-4">
				<?php require_once 'inc/sidebar.php'; ?>
			</div>
		</div>
	</div>
</section>

<footer>
	<div class="container">
		Copyright &copy by <a href="#">ALPHA</a>. All right reserved from 2017 - 2018. 
	</div>
</footer>
</body>
</html>