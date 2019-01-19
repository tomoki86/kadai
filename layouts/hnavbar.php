<div class="row">
  <div class="col-lg-12" style="text-align: center;">
    <div class="header" >
      <h3 style="color: yellow">NexSeed diary</h3>
    </div>
  </div>
</div>
<div class="navbar">
  <?php if (strpos($_SERVER['REQUEST_URI'], 'home.php') !== false): ?>
    <a class="active" href="home.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a href="register/login.php"><i class="fa fa-fw fa-user"></i> Login</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'content.php') == true):?>
  <a class="active" href="home.php"><i class="fa fa-fw fa-home"></i> Home</a> 
  <a href="register/login.php"><i class="fa fa-fw fa-user"></i> Login</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'register/login.php') == true):?>
    <a href="../home.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a class="active" href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>
  <?php endif; ?>
</div>