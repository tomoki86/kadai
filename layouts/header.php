<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>nexseed diary</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  

<!-- navbar -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- navbar終了 -->


  <style type="text/css">

  div.container-fluid{
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  div.header{
    border: 1px solid #66CCFF; background-color: #66CCFF; height: auto;
  }

  div.content{
    border: 1px solid #808080;
  }

  div.write{
    border: 1px solid #CCCCCC; height: 450px
  }

  div.footer{
    border: 1px solid #66CCFF; background-color: #66CCFF; margin-top: auto; 
  }



　/*navbarのcss*/
  body {font-family: Arial, Helvetica, sans-serif;}

  .navbar {
    width: 100%;
    background-color: #FFFFFF;
    overflow: auto;
  }

  .navbar a {
    float: left;
    padding: 12px;
    color: white;
    text-decoration: none;
    font-size: 17px;
  }

  .navbar a:hover {
    background-color:#CCCCCC;
  }

  .active {
    background-color:#E6E6E6;
  }

  @media screen and (max-width: 500px) {
    .navbar a {
      float: none;
      display: block;
    }
  }

  div.navbar>a{
    color: #66CCFF
  }
  /*navbarのcss終了*/

  div.write>.form-control {
  display: block;
  width: 100%;
  height: 90px;
 }

  .form-control-text {
  display: block;
  width: 100%;
  height: 350px;
  padding: 6px 12px;
  font-size: 25px;
  word-break : break-all;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
       -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
 }

 input.form-control {
  display: block;
  width: 40%;
  height: 17px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
       -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}

  </style>
</head>