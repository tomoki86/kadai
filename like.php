<?php
//AjaxからPOST送信される 
// session_start();

require('dbconnect.php');

$content_id = $_POST['content_id'];
$user_id = $_POST['user_id'];

if (isset($_POST['is_unlike'])) {
  // $like_sql = 'UPDATE `diary` SET `like_count` = 0 WHERE `id` = ?';
  $sql = 'DELETE FROM `likes` WHERE `content_id`=? AND `user_id`=?';
} else {
  // $like_sql = 'UPDATE `diary` SET `like_count` = 1 WHERE `id` = ?';
  $sql = 'INSERT INTO `likes` (`content_id`, `user_id`) VALUES (?, ?)';
}
// $like_data = [$_GET['like_id']];
// $like_stmt = $dbh->prepare($like_sql);
// $like_stmt->execute($like_data);

$data = [$content_id, $user_id];
$stmt = $dbh->prepare($sql);
$res = $stmt->execute($data);
echo json_encode($res);

// header('Location: home2.php');

// exit();