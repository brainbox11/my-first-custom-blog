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
					<h1 class="head"><i class=" fa fa-tachometer"></i> Messages <small>Inbox from visitors</small></h1>
					<ol class="breadcrumb">
						<li class="active"><i class="fa fa-tachometer"></i> Dashboard</li>
					</ol>

					<div class="row">
						<div class="col-sm-9">
							<?php 
							$sql = "SELECT * FROM message ORDER BY time DESC";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							if ($resultCheck < 1) {
								echo "<h1>No Messages Yet!!!</h1>";
							}

							while ($row = mysqli_fetch_assoc($result)) {

								echo '<div class="media">
										  <div class="media-left">
										    <a href="#">
										      <img width="40px" class="img-circle" src="assets/Gift.jpg" alt="Post Image">
										    </a>
										  </div>
										  <div class="media-body">
										    <h4 class="media-heading"><strong style="color: #555;">'.$row['name'].'</strong><small><a style="color: inherit;" href="mailto:'.$row['email'].'"> '.$row['email'].'</small></a></h4>
										    <p>'.nl2br($row['message']).'</p>
										    <section style="background: inherit; padding: 0;"><small>Location - <cite title="Source Title">'.$row['country'].'</cite></small></section>
										  </div>
										</div><hr>';
									}

							 ?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<footer class="text-center fixed-bottom">
			Copyright &copy;by <a href="#" >ALPHA</a> from 2017-xxxx
		</footer>
	</div>
</body>
</html>