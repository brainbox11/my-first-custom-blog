				<div class="widgets">
					<form action="index.php" method="POST">
						<div class="input-group">
					      <input type="text" name="search-title" class="form-control" placeholder="Search for...">
					      <span class="input-group-btn">
					        <button class="btn btn-default" name="search" value="Go" type="submit">Go!</button>
					      </span>
					    </div><!-- /input-group -->
					</form>
				</div><!--Widget Close-->

				<div class="widgets">
					<div class="popular">
						<h4>Popular Posts</h4>
						<?php 
						$sql3 = "SELECT id,DATE_FORMAT(time, '%W %M %D %Y'),title,image FROM post ORDER BY view DESC LIMIT 5";
		              $result3 = mysqli_query($conn, $sql3);
		              if (!$result3) {
		                echo "Error";
		              }
		              while ($row = mysqli_fetch_assoc($result3)) {
		              	$db = $row['id'];
		              	$r_date = $row["DATE_FORMAT(time, '%W %M %D %Y')"];
		              	$r_title = $row['title'];
		              	$img_p = $row['image'];
		              	$img_path = "img/pipeline2.jpg";
		              	if ($img_p != "img") {
		              		$img_path = "admin/photo/Thumb/thumb_".$img_p;
		              	}
		              	echo <<<__END
		              	<hr>
						<div class="row">
							<div class="col-xs-4">
								<img src="$img_path" alt="Image 1">
							</div>
							<div class="col-xs-8 details">
								<a href="post.php?post_id=$db"><h4>$r_title</h4></a>
								<p><i class="fa fa-clock-o"></i> $r_date</p>
							</div>
						</div>
__END;
		              }
						 ?>
						
					</div>
				</div><!--Widget Close-->

				<div class="widgets">
					<div class="popular">
						<h4>Recent Posts</h4>
						<?php 
						$sql3 = "SELECT id,DATE_FORMAT(time, '%W %M %D %Y'),title,image FROM post ORDER BY time DESC LIMIT 5";
		              $result3 = mysqli_query($conn, $sql3);
		              if (!$result3) {
		                echo "Error";
		              }
		              while ($row = mysqli_fetch_assoc($result3)) {
		              	$db = $row['id'];
		              	$r_date = $row["DATE_FORMAT(time, '%W %M %D %Y')"];
		              	$r_title = $row['title'];
		              	$img_p = $row['image'];
		              	$img_path = "img/pipeline2.jpg";
		              	if ($img_p != "img") {
		              		$img_path = "admin/photo/Thumb/thumb_".$img_p;
		              	}
		              	echo <<<__END
		              	<hr>
						<div class="row">
							<div class="col-xs-4">
								<img src="$img_path" alt="Image 1">
							</div>
							<div class="col-xs-8 details">
								<a href="post.php?post_id=$db"><h4>$r_title</h4></a>
								<p><i class="fa fa-clock-o"></i> $r_date</p>
							</div>
						</div>
__END;
		              }
						 ?>
					</div>
				</div><!--Widget Close-->

				<div class="widgets">
					<div class="popular">
						<h4>Categories</h4>
						<hr>
						<div class="row">
						<?php 
						$sql3 = "SELECT * FROM categories";
			              $result3 = mysqli_query($conn, $sql3);
			              if (!$result3) {
			                echo "Error";
			              }
			              $count = 0;
			              while ($row = mysqli_fetch_assoc($result3)) {
			              	$cat = $row['category'];
			              	$catid = $row['id'];
			              	echo '<div class="col-xs-6">
									<ul>
										<li><a href="index.php?cat='.$catid.'">'.ucfirst($cat).'</a></li>
									</ul>
								</div>';
							}

						 ?>
						</div>
					</div>
				</div><!--Widget Close-->

				<div class="widgets">
					<div class="categories">
						<h4>Social Icons</h4>
						<hr>
						<div class="row">
							<div class="col-xs-4">
								<a href=""><img class="img-responsive" src="assets/facebook.png"></a>
							</div>
							<div class="col-xs-4">
								<a href=""><img class="img-responsive" src="assets/twitter.jpg"></a>
							</div>
							<div class="col-xs-4">
								<a href=""><img class="img-responsive" src="assets/youtube.jpg"></a>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-xs-4">
								<a href=""><img class="img-responsive" src="assets/skype.png"></a>
							</div>
							<div class="col-xs-4">
								<a href=""><img class="img-responsive" src="assets/googleplus.jpg"></a>
							</div>
							<div class="col-xs-4">
								<a href=""><img class="img-responsive" src="assets/Linkedin.png"></a>
							</div>
						</div>
					</div>
				</div><!--Widget Close-->