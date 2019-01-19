    <?php
session_start();

// require(読み込みたいファイル名)
require('../dbconnect.php');

if (!isset($_SESSION['Kadai'])){
    header('Location:login.php');
             exit();
}
// echo '<pre>';
// var_dump($_SESSION);
// echo'</pre>';

// echo $_SESSION['Kadai']['name'].'<br>';
// echo $_SESSION['Kadai']['email'].'<br>';
// echo $_SESSION['Kadai']['password'].'<br>';
// echo $_SESSION['Kadai']['img_name'].'<br>';

$name =$_SESSION['Kadai']['name'];
$email =$_SESSION['Kadai']['email'];
$password =$_SESSION['Kadai']['password'];
$file_name =$_SESSION['Kadai']['img_name'];
$img_name =$_SESSION['Kadai']['img_name'];

// if (!empty($_POST)){
//     echo '送信されました';}
// POST送信時
if (!empty($_POST)){
    //1.SQL文を用意
$sql='INSERT INTO`users`(`name`,`email`,`password`,`img_name`,`created`)VALUES(?,?,?,?,NOW());';
    //2.?に代入したい値を入れる
// パスワードはハッシュ化する
$data= [$name,$email,password_hash($password,PASSWORD_DEFAULT),$img_name];
// ３.SQL文をセットする
$stmt=$dbh->prepare($sql);
//4.SQL文を実行する
$stmt->execute($data);
// ５登録完了ページに遷移
// セッションを保持したなようは不要になったら破棄すること (連想配列のみ適用)
unset($_SESSION['Kadai']);
header('Location: thanks.php');
exit();
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php include('../layouts/rheader.php'); ?>
</head>
<body>
<div class="container-fluid">
    <?php include('../layouts/hnavbar.php'); ?>
    <div class="row" style="height: 80px">
      <p>hoge</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-4">

                <img src="../user_profile_img/<?php echo htmlspecialchars($file_name)?>" class="img-responsive img-thumbnail" style="width: 250px; height: 250px; object-fit: cover">
            </div>
            <div class="col-xs-8">

                <div>
                    <span>ユーザー名</span>
                    <p class="lead"><?php echo htmlspecialchars($name)?></p>
                </div>
                <div>
                    <span>メールアドレス</span>
                    <p class="lead"><?php echo htmlspecialchars($email)?></p>
                </div>
                <div>
                    <span>パスワード</span>
                    <p class="lead">●●●●●●●●</p>
                </div>
                <form method="POST" action="check.php">
                    <!-- GET送信時のパラメーターURL？キー＝値 -->
                    <a href="signup.php?action=rewrite" class="btn btn-default">&laquo;&nbsp;戻る</a>
                     <!-- DBに登録したい値は$_SESSIONが保持されているので
                     formから送信する必要がないが、！empty（POST）処理をするために
                     input type="hiddenを使用して$_POSTを空じゃない状態にしている -->
                    <input type="hidden" name="action" value="submit">
                    <input type="submit" class="btn btn-primary" value="ユーザー登録">
                </form>
            </div>

        </div>

    </div>
    <?php include('../layouts/footer.php'); ?>
</div>
</body>
    <script src="../assets/js/jquery-3.1.1.js"></script>
    <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
</html>