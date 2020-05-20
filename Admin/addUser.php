<?php 
	require_once 'inc/top.php';

	if (isset($_POST['add_user'])) {
			$email = mysql_entities_fix_string($conn, $_POST['email']);
			$username = mysql_entities_fix_string($conn, $_POST['username']);
			$pwd = mysql_entities_fix_string($conn, $_POST['pwd']);
			$pwd2 = mysql_entities_fix_string($conn, $_POST['pwd2']);
			if ($pwd !== $pwd2) {
				header("Location: index.php?p=126");
			}
			$hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
			$location = "img";
			if (strlen($pwd) < 8) {
				header("Location: index.php?p=1266");
				exit();
			}
			$sql4 = "SELECT * FROM users WHERE email='$email'";
				$result= mysqli_query($conn, $sql4);
				$resultCheck = mysqli_num_rows($result);

			if ($resultCheck > 0) {
				header("Location: index.php?e=1234");
				exit();
			}
			if ($_FILES['file']['tmp_name']) {
				$file = $_FILES['file'];
				if (!$file['tmp_name']) {
					header("Location: post_view.php?s=error");
					exit();
				}

				$location = "photo/profile/";
				require_once 'inc/img.php';
				$fileNameNew = "TL".$fileNameNew;
				$location = $fileNameNew;
			}
			$sql = "INSERT INTO users ( email ,author, pwd, Profile ) VALUES ('$email', '$username', '$hashedpwd', '$location');";
			$result= mysqli_query($conn, $sql);
			if (!$result) {
				echo "<h1>error!!!</h1>";
				exit();
			}
			header("Location: index.php?s=done");
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
					<h1 class="head"><i class=" fa fa-users"></i> Add Users <small>Add new users</small></h1>
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-tachometer"></i> Dashboard</li>
					</ol>

					<form action="addUser.php" method="POST" enctype="multipart/form-data">
			          <div class="form-group">
					    <label for="exampleInputuser">Full-Name</label>
					    <input type="text" name="username" class="form-control" id="exampleInputuser" placeholder="Full Name" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email address</label>
					    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword">Comfirm Password</label>
					    <input type="password" name="pwd2" class="form-control" id="exampleInputPassword2" placeholder="Comfirm Password" required>
					  </div>
					  <hr>
					  <div class="form-group">
					    <label for="exampleInputFile">File input</label>
					    <input type="file" name="file" id="exampleInputFile">
					    <p class="help-block">You ensure to fill details properly.</p>
					  </div>
					  <button name="add_user" value="add_user" type="submit" class="btn btn-primary">Submit</button>
					</form>
					
				</div>
			</div>
		</div>
		<?php require_once 'inc/footer.php'; ?>
	</div>
</body>
</html>