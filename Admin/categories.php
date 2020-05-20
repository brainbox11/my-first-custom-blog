<?php 
	require_once 'inc/top.php';

	if (isset($_POST['cat-submit'])) {
		$category = $_POST['cat'];
		if (!empty($category)) {
			$sql = "INSERT INTO categories (category) VALUES ('$category')";
			$result = mysqli_query($conn, $sql);
			if (!$result) {
				echo "Error";
			}
		}

		
	}
 ?>
<body>
	<div id="wrapper">
		<?php 
			require_once 'inc/header.php';
		 ?>
		<div class="container-fluid body-section">
			<div class="row">
				<div class="col-md-3">
					<?php require_once 'inc/sidebar.php'; ?>
				</div>
				<div class="col-md-9">
					<h1 class="head"><i class=" fa fa-folder-open"></i> Categories <small>Different Categories</small></h1>
					<ol class="breadcrumb">
						<li><a href="index.html"><i class="fa fa-tachometer"></i> Dashboard</li></a>
						<li class="active"><i class="fa fa-folder-open"></i> Categories</li>
					</ol>
					
					<div class="row">
						<div class="col-md-10">
							<form action="" method="POST">
								<div class="form-group">
									<label for="Category">Category Name</label>
									<input type="text" name="cat" placeholder="Category Name" class="form-control" required />
								</div>
								<button type="submit" name="cat-submit" value="cat-submit"  class="btn btn-primary">Add Category</button>
							</form><hr>
						</div>
						
						<div class="col-md-10">
							<table class="table table-hover table-bordered table-striped">
						<thead>
							<tr>
								<th>Sr #</th>
								<th>Category Name</th>
								<th>Posts</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php 

							$count =0; 
							$sql = "SELECT * FROM categories ORDER BY category";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							if (!$result) {
								echo "Error";
							}
							if ($resultCheck < 1) {
								echo "<h1>No Category Created Yet!!!</h1>";
							}
							while ($row = mysqli_fetch_assoc($result)) {
								$count++;
								$group = $row['category'];
								
								echo "<tr>
									<td>$count</td>
									<td>$group</td>
									<td>N/A</td>
									<td><a href='#'><i class='fa fa-pencil'></i></a></td>
									<td><a href='#'><i class='fa fa-times'></i></a></td>
								</tr>";
							}

						 ?>
						</tbody>
					</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require_once 'inc/footer.php'; ?>
	</div>
</body>
</html>