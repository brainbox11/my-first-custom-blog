<?php require_once 'inc/top.php'; ?>
<body>
	<div id="wrapper">
		<?php require_once 'inc/header.php'; ?>

		<div class="container-fluid body-section">
			<div class="row">
				<?php require_once 'inc/sidebar.php'; ?>
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
									<a href="#" class="btn btn-primary">Add New</a>
								</div>
							</form>
						</div>
					</div>
					<table class="table table-bordered table-striped tabe-hover">
						<thead>
							<tr>
								<th>Sr #</th>
								<th>Date</th>
								<th>Name</th>
								<th>Username</th>
								<th>Email</th>
								<th>Image</th>
								<th>Password</th>
								<th>Role</th>
								<th>Posts</th>
								<th>Edit</th>
								<th>Del</th>
								
							</tr>
						</thead>
						<tbody>
							<tr>
							<td><input type="checkbox"/></td>
								<td>1</td>
								<td>31 August, 2017</td>
								<td>Okany Emmanuel</td>
								<td>Java Guru</td>
								<td>okanyemmanuelonyek413@gmail.com</td>
								<td><img src="img/rail6.jpg" width="30px;"/></td>
								<td>okany</td>
								<td>Admin</td>
								<td>11</td>
								<td><a href="#"><i class="fa fa-pencil"></i></a></td>
								<td><a href="#"><i class="fa fa-times"></i></a></td>
							</tr>
							<tr>
							<td><input type="checkbox"/></td>
								<td>1</td>
								<td>31 August, 2017</td>
								<td>Okany Emmanuel</td>
								<td>Java Guru</td>
								<td>okanyemmanuelonyek413@gmail.com</td>
								<td><img src="img/rail6.jpg" width="30px;"/></td>
								<td>okany</td>
								<td>Admin</td>
								<td>11</td>
								<td><a href="#"><i class="fa fa-pencil"></i></a></td>
								<td><a href="#"><i class="fa fa-times"></i></a></td>
							</tr>
							<tr>
							<td><input type="checkbox"/></td>
								<td>1</td>
								<td>31 August, 2017</td>
								<td>Okany Emmanuel</td>
								<td>Java Guru</td>
								<td>okanyemmanuelonyek413@gmail.com</td>
								<td><img src="img/rail6.jpg" width="30px;"/></td>
								<td>okany</td>
								<td>Admin</td>
								<td>11</td>
								<td><a href="#"><i class="fa fa-pencil"></i></a></td>
								<td><a href="#"><i class="fa fa-times"></i></a></td>
							</tr>
							<tr>
							<td><input type="checkbox"/></td>
								<td>1</td>
								<td>31 August, 2017</td>
								<td>Okany Emmanuel</td>
								<td>Java Guru</td>
								<td>okanyemmanuelonyek413@gmail.com</td>
								<td><img src="img/rail6.jpg" width="30px;"/></td>
								<td>okany</td>
								<td>Admin</td>
								<td>11</td>
								<td><a href="#"><i class="fa fa-pencil"></i></a></td>
								<td><a href="#"><i class="fa fa-times"></i></a></td>
							</tr>
							<tr>
							<td><input type="checkbox"/></td>
								<td>1</td>
								<td>31 August, 2017</td>
								<td>Okany Emmanuel</td>
								<td>Java Guru</td>
								<td>okanyemmanuelonyek413@gmail.com</td>
								<td><img src="img/rail6.jpg" width="30px;"/></td>
								<td>okany</td>
								<td>Admin</td>
								<td>11</td>
								<td><a href="#"><i class="fa fa-pencil"></i></a></td>
								<td><a href="#"><i class="fa fa-times"></i></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<footer class="text-center fixed-bottom">
			Copyright &copy;by <a href="#" >ALPHA</a> from 2017-xxxx
		</footer>
	</div>
</body>
</html>