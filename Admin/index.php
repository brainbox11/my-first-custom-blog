<?php 
	require_once 'inc/top.php';

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
					<h1 class="head"><i class=" fa fa-tachometer"></i> Dashboard <small>Statistics Overview</small></h1>
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-tachometer"></i> Dashboard</li>
					</ol>
					
					<div class="row tag-boxes">
						<div class="col-lg-6 col-lg-3">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-comments fa-5x"></i>
										</div>
										<div class="col-xs-9">
											<div class="text-right huge">
												<?php 
													$sql = "SELECT * FROM message";
													$result = mysqli_query($conn, $sql);
													$resultCheck = mysqli_num_rows($result);
													echo $resultCheck;
												?>
											</div>
											<div class="text-right"> New Messages </div>
										</div>
									</div>
								</div>
								<a href="message.php">
									<div class="panel-footer">
										<span class="pull-left">View All Messages</span> 
										<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-6 col-lg-3">
							<div class="panel panel-red">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-file-text fa-5x"></i>
										</div>
										<div class="col-xs-9">
											<div class="text-right huge">
												<?php 
													$sql = "SELECT * FROM post";
													$result = mysqli_query($conn, $sql);
													$resultCheck = mysqli_num_rows($result);
													echo $resultCheck;
												?>
											</div>
											<div class="text-right"> All Post </div>
										</div>
									</div>
								</div>
								<a href="post.php">
									<div class="panel-footer">
										<span class="pull-left">View All Post</span> 
										<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-6 col-lg-3">
							<div class="panel panel-yellow">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-users fa-5x"></i>
										</div>
										<div class="col-xs-9">
											<div class="text-right huge">
												<?php 
													$sql = "SELECT * FROM users";
													$result = mysqli_query($conn, $sql);
													$resultCheck = mysqli_num_rows($result);
													echo $resultCheck;
												?>
											</div>
											<div class="text-right"> View All Users </div>
										</div>
									</div>
								</div>
								<a href="user.php">
									<div class="panel-footer">
										<span class="pull-left">View All Users</span> 
										<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-6 col-lg-3">
							<div class="panel panel-green">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-folder-open fa-5x"></i>
										</div>
										<div class="col-xs-9">
											<div class="text-right huge">
												<?php 
													$sql = "SELECT * FROM categories";
													$result = mysqli_query($conn, $sql);
													$resultCheck = mysqli_num_rows($result);
													echo $resultCheck;
												?>
											</div>
											<div class="text-right"> Categories </div>
										</div>
									</div>
								</div>
								<a href="categories.php">
									<div class="panel-footer">
										<span class="pull-left">View All Categories</span> 
										<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
					</div><hr>
					
					<h3 class="head">New Users</h3>
					<table class="table table-bordered table-responsive table-striped tabe-hover">
						<thead>
							<tr>
								<th>Sr #</th>
								<th>Name</th>
								<th>Email</th>
								<th>Role</th>
								<th>Posts</th>	
							</tr>
						</thead>
						<tbody>
							<?php
								$count =0; 
								$sql = "SELECT * FROM users";
								$result = mysqli_query($conn, $sql);
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										$count++;
										$user = $row['author'];
										$email = $row['email'];
										echo "<tr>
												<td>$count</td>
												<td>$user</td>
												<td>$email</td>
												<td>Admin</td>
												<td>11</td>
											</tr>";
									}
								} else {
									echo "No User Yet";
								}						
							?>
						</tbody>
					</table>
					<a href="user.php" class="btn btn-primary">View All Users</a><hr>

					<h3 class="head">New Post</h3>
					<table class="table table-responsive table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>Sr #</th>
								<th>Date</th>
								<th>Post Title</th>
								<th>Category</th>
								<th>Views</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count =0; 
								$sql = "SELECT DATE_FORMAT(time, '%W %M %D %Y'),title, category, view FROM post ORDER BY time DESC LIMIT 4";
								$result = mysqli_query($conn, $sql);
								$resultCheck = mysqli_num_rows($result);
								if (!$result) {
									echo "Error";
								}
								if ($resultCheck < 1) {
									echo "No Post Added Yet!";
								}
								while ($row = mysqli_fetch_assoc($result)) {
									$count++;
									$title = $row['title'];
									$cate = $row['category'];
									$view = $row['view'];
									$date = $row["DATE_FORMAT(time, '%W %M %D %Y')"];
									echo "<tr>
										<td>$count</td>
										<td>$date</td>
										<td>$title</td>
										<td>$cate</td>
										<td><i class='fa fa-eye'></i>  $view</td>
									</tr>";
								}
							 ?>
						</tbody>	
					</table>
					<a href="post.php" class="btn btn-primary">View All Posts</a><hr>
				</div>
			</div>
		</div>
		<?php require_once 'inc/footer.php'; ?>
	</div>
</body>
</html>