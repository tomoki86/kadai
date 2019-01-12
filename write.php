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


$title='';
$contents='';

if(!empty($_POST)){
  $title=$_POST['title'];
  $contents=$_POST['content'];

  $sql='INSERT INTO`diary`(`title`,`contents`,`created`)VALUES(?,?,NOW());';
  $data=[$title,$contents];
  $stmt=$dbh->prepare($sql);
  $stmt->execute($data);
}



?>
<!DOCTYPE html>
<html lang="ja">
<?php include('layouts/header.php'); ?>
<body>
  <div class="container-fluid">
    <?php include('layouts/navbar.php'); ?>
    <div class="row">
      <div class="col-lg-12">
         <div class="col-xs-3">
          <h4>
            <p>log</p>
          </h4><br>
          <a class="tablinks" onclick="openCity(event, 'New')" id="defaultOpen"><?php
            // date()で日時を出力
            echo date( "Y/n" ) ;
            ?>月の日記</a><hr>

          <a class="tablinks" onclick="openCity(event, '1')"><?php
            // date()で日時を出力
            echo date( "Y/n" ) ;
            ?>月の日記</a><hr>

          <a class="tablinks" onclick="openCity(event, '2')"><?php
            echo date( "Y/n" , strtotime(date('Y/n/1') . '-1 month'));
            // date()で日時を出力
            ;?>月の日記</a><hr>

        </div>

        <div id="New" class="tabcontent">
          <div class="col-xs-9">
            <div class="write" style="border: 0px">
              <form method="POST" action="write.php" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="title" name="title" class="form-control" id="title" placeholder="title">
                </div>
                <div class="form-group">
                  <input type="content" name="content" class="form-control-text" style="width: 80%" id="content" placeholder="">
                </div>
                <input type="submit" class="btn btn-warning" value="post" >
              </form>
            </div>
          </div>
        </div>

        <div id="1" class="tabcontent">
          <div class="col-xs-9">
            <div class="content">
              <h3>こんにちわ</h3>
              <p>1月10日</p><br>
            </div>
          </div>
        </div>

        <div id="2" class="tabcontent">
          <div class="col-xs-9">
            <div class="content">
              <h3>こんにちわ</h3>
              <p>12月10日</p><br>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include('layouts/footer.php'); ?>
  </div>
</body>
<script>

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

</script>
</html>