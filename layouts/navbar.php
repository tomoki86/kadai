<div class="row">
  <div class="col-lg-12" style="text-align: center;">
    <div class="header" >
      <h3 style="color: yellow">NexSeed diary</h3>
    </div>
  </div>
</div>
<div class="navbar">
  <?php if (strpos($_SERVER['REQUEST_URI'], 'diary.php') !== false): ?>
    <a class="active" href="diary.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a href="search.php"><i class="fa fa-fw fa-search"></i> Search</a> 
    <a href="write.php"><i class="fa fa-fw fa-pencil"></i> Write</a> 
    <a href="favorite.php"><i class="fa fa-fw fa-heart"></i> favorite</a> 
    <a href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'search.php') == true):?>
    <a href="diary.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a class="active" href="search.php"><i class="fa fa-fw fa-search"></i> Search</a> 
    <a href="write.php"><i class="fa fa-fw fa-pencil"></i> Write</a> 
    <a href="favorite.php"><i class="fa fa-fw fa-heart"></i> favorite</a> 
    <a href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'write.php') == true):?>
    <a href="diary.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a href="search.php"><i class="fa fa-fw fa-search"></i> Search</a> 
    <a class="active" href="write.php"><i class="fa fa-fw fa-pencil"></i> Write</a> 
    <a href="favorite.php"><i class="fa fa-fw fa-heart"></i> favorite</a> 
    <a href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'favorite.php') == true):?>
    <a href="diary.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a href="search.php"><i class="fa fa-fw fa-search"></i> Search</a> 
    <a href="write.php"><i class="fa fa-fw fa-pencil"></i> Write</a> 
    <a class="active" href="favorite.php"><i class="fa fa-fw fa-heart"></i> favorite</a> 
    <a href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'login.php') == true):?>
    <a href="diary.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a href="search.php"><i class="fa fa-fw fa-search"></i> Search</a> 
    <a href="write.php"><i class="fa fa-fw fa-pencil"></i> Write</a> 
    <a href="favorite.php"><i class="fa fa-fw fa-heart"></i> favorite</a> 
    <a class="active"href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>
  <?php endif; ?>
</div>