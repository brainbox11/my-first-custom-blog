<?php 
 session_start();


  if (isset($_POST['login_submit'])) {
    require_once 'inc/db.php';
    require_once 'inc/function.php';

    $uid = mysql_entities_fix_string($conn, $_POST['email']);
    $pwd = mysql_entities_fix_string($conn, $_POST['pass']);

    //Error handlers
    //Check if inputs are empty
    if (empty($uid) || empty($pwd)) {
      header("Location: login.php?login=error");
      exit();

    } else {
      $sql = "SELECT * FROM users WHERE email='$uid'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck < 1) {
        header("Location: login.php?login=Unauthorizied-User!!!");
        exit();
      } else {
        if ($row = mysqli_fetch_assoc($result)) {
          // De-hashing the password
          $hashedpwdcheck = password_verify($pwd, $row['pwd']);
          if ($hashedpwdcheck == false) {
            header("Location: login.php?login=Unauthorizied-User!!!");
            exit(); 
          } elseif ($hashedpwdcheck == true) {
            // Log in the user here
            $_SESSION['uid'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['u_uid'] = $row['author'];
            $_SESSION['timestamp'] = time();
            $_SESSION['check'] = hash('ripemd128', $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
            $_SESSION['up_error'] = "";
            header("Location: index.php?login=success");
            exit();
          }
        }
      } 
    }
  }

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../bootsrap/img/favicon.jpeg">

    <title>Admin Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/animated.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script src="Scripts/jQuery-3.2.1.js"></script>
  <script src="Scripts/bootstrap.js"></script>
  </head>

  <body>

    <div class="container">

      <form class="form-signin animated shake" action="login.php" method="POST">
        <h2 class="form-signin-heading">Admin Login</h2>
        <?php if (isset($_GET['login'])) {
          echo '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>'.$_GET["login"].'</strong>
              </div>';
        } ?>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button name="login_submit" value="login_submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>
