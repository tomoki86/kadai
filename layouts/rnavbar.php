<div class="navbar" style="margin-bottom: 0px">
  <?php if (strpos($_SERVER['REQUEST_URI'], 'home.php') !== false): ?>
    <a class="active" href="../home.php"><i class="fa fa-fw fa-home"></i> Home</a> 


    <a href="register/login.php"><i class="fa fa-fw fa-user"></i> Login</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'search.php') == true):?>
    <a href="../home.php"><i class="fa fa-fw fa-home"></i> Home</a> 


    <a href="register/login.php"><i class="fa fa-fw fa-user"></i> Login</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'write.php') == true):?>
    <a href="../home.php"><i class="fa fa-fw fa-home"></i> Home</a> 


    <a href="register/login.php"><i class="fa fa-fw fa-user"></i> Login</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'favorite.php') == true):?>
    <a href="../home.php"><i class="fa fa-fw fa-home"></i> Home</a> 


    <a href="register/login.php"><i class="fa fa-fw fa-user"></i> Login</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'login.php') == true):?>
    <a href="../home.php"><i class="fa fa-fw fa-home"></i> Home</a> 


    <a class="active"href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>
  <?php endif; ?>
</div>