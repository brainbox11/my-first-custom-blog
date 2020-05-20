<?php require_once 'inc/top.php'; ?>
<body>
<?php require_once 'inc/header.php'; ?>

<?php 
	if (isset($_POST['message-submit'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$country = $_POST['country'];
		$message = $_POST['message'];

		$query = "INSERT INTO message (name, email, country, message, time) VALUES ('$name', '$email', '$country', '$message', SYSDATE())";
		$run = mysqli_query($conn, $query);
		if ($run) {
			$info = "success";
		}
	}
 ?>

<div class="jumbotron">
	<div class="container">
		<div id="detail" class="animated fadeInLeft">
			<h1>Contact us</h1>
			<p>We are available 24x7. So Feel Free to Contact Us.</p>
		</div>
	</div>
	<img src="assets/jumbotron.jpg" alt="Top-image">
</div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						
					</div>
					<div class="col-md-12 contact-form">
						<?php 
							if (isset($info)) {
								echo '<div class="alert alert-info alert-dismissible" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-info-circle"></i> 
									  <strong>Success!</strong> Message Successfully sent.
									</div>';
							}
						 ?>
						<h2>Contact Form</h2><hr>
						<form action="" method="POST">
							<div class="form-group">
								<label for="full-name">Full Name:*</label>
								<input type="text" name="name" id="full-name" class="form-control" placeholder="Full Name" required>
							</div>
							<div class="form-group">
								<label for="email">Email:*</label>
								<input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
							</div>
							<div class="form-group">
								<label for="country">Country:*</label>
								<input type="text" name="country" id="country" class="form-control" placeholder="Country" required>
							</div>
							<div class="form-group">
								<label for="message">Message:*</label>
								<textarea id="message" rows="10" cols="30" class="form-control" name="message" placeholder="Your Message should be here." required></textarea>
							</div>
							<input type="submit"  name="message-submit" value="submit" class="btn btn-primary">
						</form>
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