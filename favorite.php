<?php
session_start();
require('dbconnect.php');

if(!isset($_SESSION['Kadai']['id'])){
   header('Location:home.php');
   exit();
}

$sql='SELECT *FROM`users`WHERE`id`=?';
$data=[$_SESSION['Kadai']['id']];
$stmt=$dbh->prepare($sql);
$stmt->execute($data);
$signin_user=$stmt->fetch(PDO::FETCH_ASSOC);

$sql='SELECT `d`.* ,`u`.`name`,`u`.`img_name`FROM`diary`AS`d`LEFT JOIN`users` AS `u` ON `d`.`user_id` = `u`.`id`WHERE`like_count`=1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

while (true) {
    // $recordは要するにfeed一件の情報
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($record == false) {
        // レコードが取れなくなったらループを抜ける
        break;
    }
    $contents[]=$record;
}

?>

<!DOCTYPE html>
<html lang="ja">
<?php include('layouts/header.php'); ?>
<body>
  <div class="container-fluid">
    <?php include('layouts/navbar.php'); ?>
    <div class="row">
      <div class="col-xs-3">
          <h4>
          </h4><br>
          <a class="tablinks" onclick="openCity(event, 'like')" id="defaultOpen">いいねした記事</a><hr>

          <a class="tablinks" onclick="openCity(event, 'liked')">いいねされた記事</a><hr>

      </div>
      <div id="like" class="tabcontent">
        <?php foreach($contents as $content): ?>
          <div class="col-xs-9" style="float: right; margin-bottom: 5px;"  >
            <div class="content">
              <h3><a href="liked.php?user_id=<?php echo$content['user_id'];?>"><?php echo$content['title'];?></a></h3>
              <p>name: <?php echo $content['name'];?><p></p><?php echo$content['created'];?>
             </p>
            </div>
          </div>
        <?php endforeach ;?>
      </div>

      <div id="liked" class="tabcontent">

      </div>
    </div>
    <?php include('layouts/footer.php'); ?>
  </div>
</body>