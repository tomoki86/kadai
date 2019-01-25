$(function() {
  $(document).on('click', '.js-like', function() {
    var content_id = $(this).siblings('.content-id').text();
    var user_id = $('.signin-user').text();
    //#signin-user->.signin-user変更しtimeline.phpのclassも変更
    //var=variable PHPの＄..と同じ
    console.log(content_id);
    console.log(user_id);

     var like_btn = $(this);
    // var like_count = $(this).siblings('.like-count').text();
    // .でclassを指定している


     $.ajax({
      // 送信先や送信するデータなど
      url: 'like.php',
      type: 'POST',
      //基本はPOST
      datatype: 'json',
      //テンプレート
      data: {
        'content_id': content_id,
        'user_id': user_id
        //キー＝値
      }
    }).done(function (data) {
      // 成功時の処理
       if (data == 'true') {
        // like_count++;
        // like_btn.siblings('.like-count').text(like_count);

        like_btn.children('span').text('cancel');

        like_btn.addClass('js-unlike');
        like_btn.removeClass('js-like');

        like_btn.addClass('btn-info');
        like_btn.removeClass('btn-default');
      }

      // console.log(data);
    }).fail(function (e) {
      // 失敗時の処理
      console.log(e);
    })


  });

  $(document).on('click', '.js-unlike', function() {
    var content_id = $(this).siblings('.content-id').text();
    var user_id = $('.signin-user').text();
    //#signin-user->.signin-user変更しtimeline.phpのclassも変更
    //var=variable PHPの＄..と同じ
    console.log(content_id);
    console.log(user_id);

     var like_btn = $(this);
    // var like_count = $(this).siblings('.like-count').text();
    // .でclassを指定している


     $.ajax({
      // 送信先や送信するデータなど
      url: 'like.php',
      type: 'POST',
      //基本はPOST
      datatype: 'json',
      //テンプレート
      data: {
        'content_id': content_id,
        'user_id': user_id,
        'is_unlike': true
        //キー＝値
      }
    }).done(function (data) {
      // 成功時の処理
       if (data == 'true') {
        // like_count--;
        // like_btn.siblings('.like-count').text(like_count);

        like_btn.children('span').text('like');
        
        like_btn.addClass('js-like');
        like_btn.removeClass('js-unlike');

        like_btn.addClass('btn-default');
        like_btn.removeClass('btn-info');
      }

      // console.log(data);
    }).fail(function (e) {
      // 失敗時の処理
      console.log(e);
    })


  });
});
//js-likeがついているcssが選択された時に機能する。
// JavaScriptのconsole.logはPHPのechoのようなもので、その出力内容はConsoleタブに表示されます

//Ajax-> (js->PHP->SQL) を用いた非同期処理
