<?php require_once 'inc/top.php'; ?>
<body>
	<div id="wrapper">
		<?php require_once 'inc/header.php'; ?>

		<div class="container-fluid body-section">
			<div class="row">
				<div class="col-md-3">
					<?php require_once 'inc/sidebar.php'; ?>
				</div>
				<div class="col-md-9">
					<h1 class="head"><i class=" fa fa-folder-open"></i> Users <small>view all Users</small></h1>
					<ol class="breadcrumb">
						<li><a href="index.html"><i class="fa fa-tachometer"></i> Dashboard</li></a>
						<li class="active"><i class="fa fa-folder-open"></i> Users</li>
					</ol>
					<div class="row">
						<div class="col-sm-8">
							<form action="">
								<div class="col-xs-4">
									<div class="form-group">
										<select name="" id="" class="form-control">
											<option value="delete">Delete</option>
											<option value="author">Change to author</option>
											<option value="admin">Change to admin</option>
										</select>
									</div>
								</div>
								<div class="col-xs-8">
									<input type="submit" class="btn btn-success" value="apply"/>
									<a href="addUser.php" class="btn btn-primary">Add New</a>
								</div>
							</form>
						</div>
					</div>
					<table class="table table-bordered table-striped tabe-hover">
						<thead>
							<tr>
								<th>Sr #</th>
								<th>Name</th>
								<th>Email</th>
								<th>Role</th>
								<th>Posts</th>
								<th>Del</th>	
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
												<td><a href=''><i class='fa fa-times'></i></a></td>
											</tr>";
									}
								} else {
									echo "No User Yet";
								}						
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php require_once 'inc/footer.php'; ?>
	</div>
</body>
</html>