<?php
session_start();
require('dbconnect.php');

date_default_timezone_set('japan');
$time = intval(date('H'));

$sql='SELECT *FROM`users`WHERE`id`=?';
$data=[$_SESSION['Kadai']['id']];
$stmt=$dbh->prepare($sql);
$stmt->execute($data);
$signin_user=$stmt->fetch(PDO::FETCH_ASSOC);

$target = date('Y-m-d');

$month_first = date('Y-m-d 00:00:00', strtotime('first day of' . $target));
$month_last = date('Y-m-d 23:59:59',strtotime('last day of'.$target));

$month_first1 = date('Y-m-d 00:00:00', strtotime('first day of -1 month' . $target));
$month_last1 = date('Y-m-d 23:59:59',strtotime('last day of -1 month'.$target));

$month_first2 = date('Y-m-d 00:00:00', strtotime('first day of -2 month' . $target));
$month_last2 = date('Y-m-d 23:59:59',strtotime('last day of -2 month'.$target));

// echo'<pre>';
// echo var_dump($month_first1);
// echo'</pre>';

$sql='SELECT `d`.* ,`u`.`name`,`u`.`img_name`FROM`diary`AS`d`LEFT JOIN`users` AS `u` ON `d`.`user_id` = `u`.`id`WHERE`d`.`created`BETWEEN ? AND ?' ;
$data=[$month_first,$month_last];
$stmt=$dbh->prepare($sql);
$stmt->execute($data);


while (true) {

  // $recordは要するにfeed一件の情報
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($record == false) {

    // レコードが取れなくなったらループを抜ける
    break;
  }
  $like_flg_sql = 'SELECT * FROM `likes` WHERE `user_id` = ? AND `content_id` = ?';
      // likesテーブルからuser_idがサインインしているユーザーのid且つfeed_idが投稿データのidのレコードデータを取得
  $like_flg_data = [$signin_user['id'], $record['id']];
  $like_flg_stmt = $dbh->prepare($like_flg_sql);
  $like_flg_stmt->execute($like_flg_data);
  $is_liked = $like_flg_stmt->fetch(PDO::FETCH_ASSOC);
  $record['is_liked'] = $is_liked ? true : false; // 三項演算子
  $contents[]=$record;
}
  echo'<pre>';
  echo var_dump($signin_user['id']);
  echo'</pre>';
  echo'<pre>';
  echo var_dump($record);
  echo'</pre>';

// $like = [];
// $like_sql='SELECT * FROM`likes`';
// $like_stmt = $dbh->prepare($like_sql);
// $like_stmt->execute();

// while (true) {
//     // $recordは要するにfeed一件の情報
//     $record3 = $like_stmt->fetch(PDO::FETCH_ASSOC);
//     if ($record3 == false) {
//         // レコードが取れなくなったらループを抜ける
//         break;
//     }
//     $like[]=$record3;
// }

$sql='SELECT `d`.* ,`u`.`name`,`u`.`img_name`FROM`diary`AS`d`LEFT JOIN`users` AS `u` ON `d`.`user_id` = `u`.`id`WHERE`d`.`created`BETWEEN ? AND ?' ;
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

$sql='SELECT `d`.* ,`u`.`name`,`u`.`img_name`FROM`diary`AS`d`LEFT JOIN`users` AS `u` ON `d`.`user_id` = `u`.`id`WHERE`d`.`created`BETWEEN ? AND ?' ;
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

<?php include('layouts/header.php'); ?>
<body>
  <div class="container-fluid">

    <?php include('layouts/navbar.php'); ?>

    <div class="row">

        <div class="col-xs-3">
          <h4>
          <?php if (6 <= $time && $time <= 11) {
          echo 'おはようございます。'.$signin_user['name'].'さん';
          }elseif (11 < $time && $time < 18) {
          echo '午後は流し作業。'.$signin_user['name'].'さん';
          }else {
          echo '今日も一日お疲れ様です。'.$signin_user['name'].'さん';
          }
          ?>
          </h4><br>
          <a class="tablinks" onclick="openCity(event, 'New')" id="defaultOpen"><?php
            // date()で日時を出力
            echo date( "Y/n" ) ;
            ?>月の日記</a><hr>

          <a class="tablinks" onclick="openCity(event, 'Pre')"><?php
            echo date( "Y/n" , strtotime(date('Y/n/1') . '-1 month'));
            // date()で日時を出力
            ;?>月の日記</a><hr>

          <a class="tablinks" onclick="openCity(event, '2mon')"><?php
            echo date("Y/n", strtotime(date('Y/n/1') . '-2 month'));
            // date()で日時を出力
            ;?>月の日記</a><hr>
        </div>

        <div id="New" class="tabcontent">

          <?php foreach($contents as $content): ?>
              <div class="col-xs-9" style="float: right; margin-bottom: 5px;"  >
                <div class="content">
                  <h3><a href="content2.php?user_id=<?php echo$content['user_id'];?>"><?php echo$content['title'];?></a></h3>
                  <p>name: <?php echo $content['name'];?><p></p><?php echo$content['created'];?>

                   <?php if($signin_user['id']!=$content['user_id']): ?>

                      <?php if($content['is_liked']): ?>
                        <button class="btn btn-info js-unlike"><span>cancel</span></button>

                      <?php else: ?>
                        <button class="btn btn-default js-like"><span>like</span></button>

                      <?php endif; ?>

                   <?php endif; ?>
                 </p>
                </div>
              </div>
          <?php endforeach ;?>

        </div>

        <div id="Pre" class="tabcontent">
          <?php foreach($contents1 as $content1): ?>
              <div class="col-xs-9" style="float: right; margin-bottom: 5px;"  >
                <div class="content">
                  <h3><a href="content.php"><?php echo$content['title'];?></a></h3>
                  <p>name: <?php echo $content['name'];?><p></p><?php echo$content1['created'];?></p><br>
                </div>
              </div>
          <?php endforeach ;?>
        </div>

        <div id="2mon" class="tabcontent">
          <?php foreach($contents2 as $content2): ?>
              <div class="col-xs-9" style="float: right; margin-bottom: 5px;"  >
                <div class="content">
                  <h3><a href="content.php"><?php echo$content['title'];?></a></h3>
                  <p>name: <?php echo $content['name'];?><p></p><?php echo$content2['created'];?></p><br>
                </div>
              </div>
          <?php endforeach ;?>
        </div>

      </div>
    <?php include('layouts/footer.php'); ?>
  </div>
</body>
<?php include('layouts/script.php'); ?>
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