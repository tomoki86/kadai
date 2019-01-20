<?php
session_start();
require('dbconnect.php');


if(!isset($_SESSION['Kadai']['id'])){
   header('Location:home.php');
   exit();
}

$errors = [];

$sql='SELECT *FROM`users`WHERE`id`=?';
$data=[$_SESSION['Kadai']['id']];
$stmt=$dbh->prepare($sql);
$stmt->execute($data);
$signin_user=$stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($_POST)) {
    $name = $_POST['input_name'];
    $email = $_POST['input_email'];

    if($_FILES['input_img_name']['name']!=''){
        $file_name = $_FILES['input_img_name']['name'];

        echo'<pre>';
        var_dump($signin_user);
        echo'</pre>';


        // 画像が選択されている時の処理
        // 拡張子チェック
        // 1. 画像ファイル名の拡張子を取得
        // substr(文字列, 何文字目から)
        // 指定されたレンジの文字列を取得
        $file_type = substr($file_name, -3); // PNG
        // 2. 大文字は小文字化
        $file_type = strtolower($file_type); // png
        // 3. jpg,png,gifと比較し、当てはまらない場合$errors['img_name']に格納
        if ($file_type != 'png' && $file_type != 'jpg' && $file_type != 'gif') {
            $errors['img_name'] = 'type';
        }

        // バリデーション成功時の処理 = 入力不備がなかった時

            // 1. プロフィール画像のアップロード
            // 一意のファイル名を設定
        $date_str = date('YmdHis');
        $submit_file_name = $date_str . $file_name;
        // アップロード
        // move_uploaded_file(画像ファイル, アップロード先)
        move_uploaded_file($_FILES['input_img_name']['tmp_name'], 'user_profile_img/' . $submit_file_name);
        // 2. セッションへ送信データを保存する
        // サーバに用意された一時的にデータを保持できる機能
        // 同じサーバ内であれば出し入れ自由
        // $_SESSION 連想配列形式で値を保持
        // 使用するためにはsession_start();をファイルの先頭に書く必要がある
        $sql = 'UPDATE `users` SET `name`= ?,`email`=?,`img_name`=? WHERE `id` = ?';
        $data = [$_POST['input_name'],$_POST['input_email'],$submit_file_name,$_POST['user_id']];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

    }else{
        $sql = 'UPDATE `users` SET `name`= ?,`email`=? WHERE `id` = ?';
        $data = [$_POST['input_name'],$_POST['input_email'],$_POST['user_id']];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
    }


    // 3. 次のページへ遷移する
    // header('Location: 遷移先')
    // die();
    header('Location: edit.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="ja">
<?php include('layouts/header.php'); ?>
<body>
  <div class="container-fluid">
    <?php include('layouts/navbar.php'); ?>
    <div class="row" style="margin-top: 40px">

      <form class="form-group" method="post" action="edit.php" enctype="multipart/form-data">

        <div class="col-xs-6" style="margin-top: 40px">
          <img src="user_profile_img/<?php echo $signin_user['img_name'];?>" style="width: 150px; height: 150px; object-fit: cover; margin-left: 250px"><p style="margin-left: 290px">profile_img </p>

            <label for="img_name" style="margin-left: 255px">プロフィール画像変更</label>
            <input type="file" name="input_img_name" style="margin-left: 210px" id="img_name" accept="image/*">
        </div>

        <div class="col-xs-6">
          join: <?php echo $signin_user['created'];?><br><br>
          name: <input type="text" name="input_name" class="form-control" id="name" placeholder="山田 太郎" style="height: 30px" value="<?php echo $signin_user['name']; ?>"><br><br>

          email: <input type="email" name="input_email" class="form-control" id="email" placeholder="example@gmail.com" style="height: 30px"value="<?php echo htmlspecialchars($signin_user['email']); ?>"><br><br>
        </div>

        <input type="hidden" name="user_id" value="<?php echo $signin_user['id']; ?>" >

        <input type="submit" value="Update(変更)" class="btn btn-warning ">

      </form>

    </div>
    <?php include('layouts/footer.php'); ?>
  </div>
</body>