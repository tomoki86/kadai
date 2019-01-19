<?php
require("dbconnect.php");

if(!isset($_GET['like_id'])){
  header("Location: home2.php");
  exit();
}


$content_id = $_POST['content_id'];
$user_id = $_POST['user_id'];


if(isset($_GET['unlike'])){
  $sql = 'UPDATE `diary` SET `like_count` = 0 WHERE `id` = ?';
}else{
  $sql = 'UPDATE `diary` SET `like_count` = 1 WHERE `id` = ?';
}
$data = [$_GET['like_id']];
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

 header('Location: home2.php');
exit();
 ?>