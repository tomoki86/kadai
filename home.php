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
// echo var_dump($month_first);
// echo'</pre>';
// echo'<pre>';
// echo var_dump($month_last);
// echo'</pre>';

$sql='SELECT `d`.* ,`u`.`name`,`u`.`img_name`FROM`diary`AS`d`LEFT JOIN`users` AS `u` ON `d`.`user_id` = `u`.`id`WHERE`d`.`created`BETWEEN ? AND ?';
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
    $contents[]=$record;
}
// echo'<pre>';
// echo var_dump($contents);
// echo'</pre>';

// echo'<pre>';
// echo var_dump($contents);
// echo'</pre>';


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

<?php include('layouts/header.php'); ?>
<body>
<div class="container-fluid">

  <?php include('layouts/hnavbar.php'); ?>

    <div class="row">

      <div class="col-xs-3">
        <h4>
        <?php if (6 <= $time && $time <= 11) {
        echo 'おはようございます、ゲストさん';
        }elseif (11 < $time && $time < 18) {
        echo 'こんにちわ、ゲストさん';
        }else {
        echo 'こんばんわ、ゲストさん';
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
                <h3><a href="content.php?content_id=<?php echo$content['id'];?>"><?php echo$content['title'];?></a></h3>
                <p>name: <?php echo $content['name'];?><p></p><?php echo$content['created'];?></p><br>
              </div>
            </div>
        <?php endforeach ;?>
      </div>

      <div id="Pre" class="tabcontent">
        <?php foreach($contents1 as $content1): ?>
            <div class="col-xs-9" style="float: right; margin-bottom: 5px;"  >
              <div class="content">
                <h3><a href="content.php"><?php echo$content1['title'];?></a></h3>
                <p><?php echo$content1['created'];?></p><br>
              </div>
            </div>
        <?php endforeach ;?>
      </div>

      <div id="2mon" class="tabcontent">
        <?php foreach($contents2 as $content2): ?>
            <div class="col-xs-9" style="float: right; margin-bottom: 5px;"  >
              <div class="content">
                <h3><a href="content.php"><?php echo$content2['title'];?></a></h3>
                <p><?php echo$content2['created'];?></p><br>
              </div>
            </div>
        <?php endforeach ;?>
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