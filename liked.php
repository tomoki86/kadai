<?php
session_start();
require('dbconnect.php');

if(!isset($_GET['user_id'])){
    header('Location: home.php');
    exit();
}

$user_id=$_GET['user_id'];


$sql='SELECT *FROM`users`WHERE`id`=?';
$data=[$_SESSION['Kadai']['id']];
$stmt=$dbh->prepare($sql);
$stmt->execute($data);
$signin_user=$stmt->fetch(PDO::FETCH_ASSOC);


$sql='SELECT `d`.* ,`u`.`name`,`u`.`img_name`,`u`.`created`FROM`diary`AS`d`LEFT JOIN`users` AS `u` ON `d`.`user_id` = `u`.`id`WHERE `d`.`user_id`=?' ;
$data=[$user_id];
$stmt=$dbh->prepare($sql);
$stmt->execute($data);
$content=$stmt->fetch(PDO::FETCH_ASSOC);

// echo'<pre>';
// var_dump($user_id);
// echo'</pre>';

?>

<?php include('layouts/header.php'); ?>
<head>

<link rel="stylesheet" type="text/css" href="assets/css/content.css"></style>

<body>
  <div class="container-fluid">

    <?php include('layouts/hnavbar.php'); ?>

    <div class="row" style="margin-top: 20px">

        <div class="col-xs-5 " style="text-align: right; ">
          <img src="user_profile_img/<?php echo $signin_user['img_name'];?>" style="width: 50px; height: 50px; object-fit: cover">
        </div>

        <div class="col-xs-7">
          <h4>name: <?php echo $content['name']; ?></h4><br><br>
        </div>
    </div>

    <div class="row " style="text-align: center">
      <form method="post" action="edit.php" enctype="multipart/form-data">
          created: <?php echo $content['created'];?><br><br>
        <div class="box" style="height:350px; padding: 0.5em 1em; margin-top: 10px margin: 2em 0;border: double 5px #4ec4d3;}">
          <h3 style="margin-top:0px; margin-bottom: 0px; ">title: <?php echo $content['title'];?></h3><hr style="margin-top: 10px; margin-bottom: 10px">
           <p><?php echo $content['contents']?></p>
        </div>
      </form>
    </div>
    <?php include('layouts/footer.php'); ?>
  </div>
</body>

</html>