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

if(!empty($_POST)){
    $name =$_POST['input_name'];
    $email =$_POST['input_email'];
    if ($name == '') {
        $errors['input_name'] = 'blank';
      }
    if ($email == '') {
        $errors['input_email'] = 'blank';
      }
    if(empty($errors)){
        //更新ボタンを押すとupdate
        $sql = 'UPDATE `users` SET `name`= ?,`email`=? WHERE `id` = ?';
        $data = [$_POST['input_name'],$_POST['input_email'],$_POST['user_id']];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        //マイページから遷移してるのでマイページへ返す
        header('Location: edit.php');
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="ja">
<?php include('layouts/header.php'); ?>
<body>
  <div class="container-fluid">
    <?php include('layouts/navbar.php'); ?>
    <div class="row" style="margin-top: 25px">
      <form class="form-group" method="post" action="edit.php">
        <div class="col-xs-6" style="margin-top: 50px">
          <img src="user_profile_img/<?php echo $signin_user['img_name'];?>" style="width: 150px; height: 150px; object-fit: cover; margin-left: 200px">
        </div>
        <div class="col-xs-6">
          join: <?php echo $signin_user['created'];?><br><br>
          name: <input type="text" name="input_name" class="form-control" id="name" placeholder="山田 太郎" style="height: 30px" value="<?php echo $signin_user['name']; ?>"><br><br>

          email: <input type="email" name="input_email" class="form-control" id="email" placeholder="example@gmail.com" style="height: 30px"value="<?php echo htmlspecialchars($signin_user['email']); ?>"><br><br>
          <input type = "hidden" name = "user_id" value = "<?php echo $signin_user['id']; ?>">
        <input type="submit" value="Update(変更)" class="btn btn-warning ">
        </div>
      </form>
    </div>
    <?php include('layouts/footer.php'); ?>
  </div>
</body>