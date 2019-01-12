<div class="row">
  <div class="col-lg-12" style="text-align: center;">
    <div class="header" >
      <h3 style="color: yellow">NexSeed diary</h3>
    </div>
  </div>
</div>
<div class="navbar">
  <?php if (strpos($_SERVER['REQUEST_URI'], 'home2.php') !== false): ?>
    <a class="active" href="home2.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a href="write.php"><i class="fa fa-fw fa-pencil"></i> Write</a> 
    <a href="favorite.php"><i class="fa fa-fw fa-heart"></i> favorite</a> 
    <a href="edit.php"><i class="fa fa-fw fa-user"></i><?php echo$signin_user['name'];?></a><img src="user_profile_img/<?php echo $signin_user['img_name'];?>" style="width: 40px; height: 40px; object-fit: cover; padding-top:12px ">
    <a href="home.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'write.php') == true):?>
    <a href="home2.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a class="active" href="write.php"><i class="fa fa-fw fa-pencil"></i> Write</a> 
    <a href="favorite.php"><i class="fa fa-fw fa-heart"></i> favorite</a> 
    <a href="edit.php"><i class="fa fa-fw fa-user"></i><?php echo$signin_user['name'];?></a><img src="user_profile_img/<?php echo $signin_user['img_name'];?>" style="width: 40px; height: 40px; object-fit: cover; padding-top:12px ">
    <a href="home.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'favorite.php') == true):?>
    <a href="home2.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a href="write.php"><i class="fa fa-fw fa-pencil"></i> Write</a> 
    <a class="active" href="favorite.php"><i class="fa fa-fw fa-heart"></i> favorite</a> 
    <a href="edit.php"><i class="fa fa-fw fa-user"></i><?php echo$signin_user['name'];?></a><img src="user_profile_img/<?php echo $signin_user['img_name'];?>" style="width: 40px; height: 40px; object-fit: cover; padding-top:12px ">
    <a href="home.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'edit.php') == true):?>
    <a href="home2.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a href="write.php"><i class="fa fa-fw fa-pencil"></i> Write</a> 
    <a href="favorite.php"><i class="fa fa-fw fa-heart"></i> favorite</a> 
    <a class="active" href="edit.php"><i class="fa fa-fw fa-user"></i><?php echo$signin_user['name'];?></a><img src="user_profile_img/<?php echo $signin_user['img_name'];?>" style="width: 40px; height: 40px; object-fit: cover; padding-top:12px ">
    <a href="home.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>

  <?php elseif (strpos($_SERVER['REQUEST_URI'], 'home.php') == true):?>
    <a href="home.php"><i class="fa fa-fw fa-home"></i> Home</a> 
    <a href="write.php"><i class="fa fa-fw fa-pencil"></i> Write</a> 
    <a href="favorite.php"><i class="fa fa-fw fa-heart"></i> favorite</a> 
    <a class="active"href="home.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>

  <?php endif; ?>
</div>