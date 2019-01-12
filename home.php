<?php
require('dbconnect.php');

date_default_timezone_set('japan');
$time = intval(date('H'));

$sql='SELECT *FROM`diary`WHERE`created`';
$stmt=$dbh->prepare($sql);
$stmt->execute();
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
// var_dump($contents);
// echo'</pre>';

?>

<?php include('layouts/header.php'); ?>
<body>
  <div class="container-fluid">

    <?php include('layouts/hnavbar.php'); ?>

    <div class="row">
      <div class="col-xs-12">

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
                  <div class="col-xs-9" style="float: right" >
                    <div class="content">
                      <h3><?php echo$content['title'];?></h3>
                      <p><?php echo$content['updated'];?></p><br>
                    </div>
                  </div>
              <?php endforeach ;?>
            </div>

            <div id="Pre" class="tabcontent">
              <div class="col-xs-9">
                <div class="content">
                  <h3>こんにちわ</h3>
                  <p>12月10日</p><br>
                </div>
              </div>
            </div>

            <div id="2mon" class="tabcontent">
              <div class="col-xs-9">
                <div class="content">
                  <h3>こんにちわ</h3>
                  <p>11月10日</p><br>
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