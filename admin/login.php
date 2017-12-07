<?php
require_once '../php/db.php';

if(!isset($_SESSION['is_login']) && $_SESSION['is_login']){
  header("Location: index.php");
}
 ?>

<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>註冊會員</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name ="description" content="Alex 測試作品網站!">
    <meta name ="author" content="Alex">
    <!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/titleico.png">

    <link rel="stylesheet" href="../css/style.css">

  </head>

  <body>
    <div class="jumbotron">
      <div class="container">
        <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
        <div class="row">
          <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
          <div class="col-xs-12">
            <!--網站標題-->

              <h1 class="text-center" style="width: 1000px;">Alex webisite  <span class="badge badge-secondary">登入頁面</span></h1>
            </div>
          </div>
        </div>
      </div>
    <!-- 網站內容 -->
    <div class="main">
      <div class="content">
        <div class="container">
          <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
          <div class="row">
            <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
            <div class="col-xs-10 col-sm-6 offset-md-3" >
              <form class="from-horizontal" id="login_form" method="post" action="php/add_user.php">
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label">會員帳號</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" id="username" placeholder="請設定您的帳號" required>
                    <div class="invalid-feedback">
                      帳號已重複
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label">會員密碼</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" placeholder="請設定您的密碼" required>
                    <div class="invalid-feedback">
                      請再次確認您的密碼
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xs-12 col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary">登入</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 頁底 -->
    <?php include_once 'footer.php'; ?>


    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
      $(document).on("ready",function(){
        //檢查帳號是否重複

        $("#login_form").on("submit",function(){

            $.ajax({
			        type : "POST",	//表單傳送的方式 同 form 的 method 屬性
			        url : "../php/verify_user.php",  //目標給哪個檔案 同 form 的 action 屬性
			        data : {	//為要傳過去的資料，使用物件方式呈現，因為變數key值為英文的關係，所以用物件方式送。ex: {name : "輸入的名字", password : "輸入的密碼"}
                'u' : $("#username").val(),
                'pw' : $("#password").val(),
			        },
			        dataType : 'html' //設定該網頁回應的會是 html 格式
			      }).done(function(data) {
			        if(data == "yes")
			        {
                window.location.href="index.php";
			        }
			        else
			        {
                alert("登入失敗，請確認帳密");
			        }

			      }).fail(function(jqXHR, textStatus, errorThrown) {
			      	//失敗的時候
			      	alert("有錯誤產生，請看 console log");
			        console.log(jqXHR.responseText);
			      });
          return false;
        });
      });
    </script>
    <?php
    //結束mysql連線
    //mysql_close();
    ?>
  </body>
</html>
