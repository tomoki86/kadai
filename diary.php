<?php

date_default_timezone_set('japan');
$time = intval(date('H'));

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>nexseed diary</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <style type="text/css">
  div.header{
    border: 1px solid #66CCFF; background-color: #66CCFF; height: auto;
  }

  div.content{
    border: 1px solid #000000;
  }

  div.footer{
    border: 1px solid #66CCFF; background-color: #66CCFF; height: auto;
  }

  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12" style="text-align: center; height: 100px">
        <div class="header" >
          <h3 style="color: yellow">NexSeed diary</h3>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="col-xs-3">
          <h4>
          <?php if (6 <= $time && $time <= 11) {
          echo 'おはようございます';
          }elseif (11 < $time && $time < 18) {
          echo 'こんにちわ、ゲストさん';
          }else {
          echo 'こんばんわ、ゲストさん';
          }
          ?>
            </h4><br>
          <a href=""> <?php
            // date()で日時を出力
            echo date( "Y/n" ) ;
            ?>月の日記</a><hr>

          <a href=""><?php
            echo date( "Y/n" , strtotime(date('Y/n/1') . '-1 month'));
            // date()で日時を出力
            ;?>月の日記</a><hr>

          <a href=""><?php
            echo date("Y/n", strtotime(date('Y/n/1') . '-2 month'));
            // date()で日時を出力
            ;?>月の日記</a><hr>

        </div>
        <div class="col-xs-9">
          <div class="content">
            <h3>こんにちわ</h3>
            <p>10月10日</p><br>
          </div>
          <div class="content">
            <h3>こんにちわ</h3>
            <p>10月10日</p><br>
          </div>
          <div class="content">
            <h3>こんにちわ</h3>
            <p>10月10日</p><br>
          </div>
          <div class="content">
            <h3>こんにちわ</h3>
            <p>10月10日</p><br>
          </div>
          <div class="content">
            <h3>こんにちわ</h3>
            <p>10月10日</p><br>
          </div>
          <div class="content">
            <h3>こんにちわ</h3>
            <p>10月10日</p><br>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="footer">
        <p style="text-align: center; color: white">copyright</p>
      </div>
    </div>
  </div>
</body>
</html>