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

echo'<pre>';
echo var_dump($data);
echo'</pre>';

$title='';
$article='';

if(!empty($_POST)){
  $title=$_POST['title'];
  $article=$_POST['content'];

  $sql='INSERT INTO`diary`(`title`,`contents`,`user_id`,`created`)VALUES(?,?,?,NOW());';
  $data=[$title,$article,$signin_user['id']];
  $stmt=$dbh->prepare($sql);
  $stmt->execute($data);
}

$target = date('Y-m-d');

$month_first = date('Y-m-d 00:00:00', strtotime('first day of' . $target));
$month_last = date('Y-m-d 23:59:59',strtotime('last day of'.$target));

$month_first1 = date('Y-m-d 00:00:00', strtotime('first day of -1 month' . $target));
$month_last1 = date('Y-m-d 23:59:59',strtotime('last day of -1 month'.$target));

$month_first2 = date('Y-m-d 00:00:00', strtotime('first day of -2 month' . $target));
$month_last2 = date('Y-m-d 23:59:59',strtotime('last day of -2 month'.$target));



$sql='SELECT `d`.* ,`u`.`id`,`u`.`name`,`u`.`img_name`FROM`diary`AS`d`LEFT JOIN`users` AS `u` ON `d`.`user_id` = `u`.`id`WHERE(`d`.`created`BETWEEN ? AND ?),`u`.`id`=`?`';
$data=[$month_first,$month_last,$_SESSION['Kadai']['id']];
$stmt=$dbh->prepare($sql);
$stmt->execute($data);

while (true) {
    // $recordは要するにfeed一件の情報
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($record == false) {
        // レコードが取れなくなったらループを抜ける
        break;
    }
    $contents[]=$record;
}


$sql='SELECT *FROM`diary`WHERE`created`BETWEEN ? AND ?';
$data=[$month_first1,$month_last1];
$stmt=$dbh->prepare($sql);
$stmt->execute($data);

while (true) {
    // $recordは要するにfeed一件の情報
    $record1 = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($record1 == false) {
        // レコードが取れなくなったらループを抜ける
        break;
    }
    $contents1[]=$record1;
}

$sql='SELECT *FROM`diary`WHERE`created`BETWEEN ? AND ?';
$data=[$month_first2,$month_last2];
$stmt=$dbh->prepare($sql);
$stmt->execute($data);

while (true) {
    // $recordは要するにfeed一件の情報
    $record2 = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($record2 == false) {
        // レコードが取れなくなったらループを抜ける
        break;
    }
    $contents2[]=$record2;
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
          <div class="col-xs-9" style="height: 270px">
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
          <?php foreach($contents as $content): ?>
              <div class="col-xs-9" style="float: right; margin-bottom: 5px;">
                <div class="content">
                  <h3><a href="content.php"><?php echo$content['title'];?></a></h3>
                  <p><?php echo$content['updated'];?></p><br>
                </div>
              </div>
          <?php endforeach ;?>
        </div>

        <div id="1" class="tabcontent">
          <div class="col-xs-9" style="height: 270px">
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
          <?php foreach($contents1 as $content1): ?>
            <div class="col-xs-9" style="float: right; margin-bottom: 5px;"  >
              <div class="content">
                <h3><a href="content.php"><?php echo$content['title'];?></a></h3>
                <p><?php echo$content1['created'];?></p><br>
              </div>
            </div>
          <?php endforeach ;?>
        </div>

        <div id="2" class="tabcontent">
          <div class="col-xs-9" style="height: 270px">
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
          <?php foreach($contents2 as $content2): ?>
            <div class="col-xs-9" style="float: right; margin-bottom: 5px;"  >
              <div class="content">
                <h3><a href="content.php"><?php echo$content['title'];?></a></h3>
                <p><?php echo$content2['created'];?></p><br>
              </div>
            </div>
          <?php endforeach ;?>
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