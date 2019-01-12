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


?>

<!DOCTYPE html>
<html lang="ja">
<?php include('layouts/header.php'); ?>
<body>
  <div class="container-fluid">
    <?php include('layouts/navbar.php'); ?>
    <?php include('layouts/footer.php'); ?>
  </div>
</body>