<!--The header section-->
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a style="color: #fff;" class="navbar-brand" href="index.php">Transport and Logistics
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-text"></i> Pages <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-alt"></i> Categories <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php 
              $query = "SELECT * FROM categories ORDER BY id DESC;";
              $run = mysqli_query($conn, $query);
              if (mysqli_num_rows($run) > 0) {
                while ($row = mysqli_fetch_assoc($run)) {
                  $cat = ucfirst($row['category']);
                  $id = $row['id'];
                  echo '<li><a href="index.php?cat='.$id.'">'.$cat.'</a></li>';
                }
              } else {
                echo '<li><a href="#">No Categories Yet</a></li>';
              }
             ?>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        <li><a href="contact-us.php"><i class="fa fa-phone"></i> Contact us</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--End of header section-->