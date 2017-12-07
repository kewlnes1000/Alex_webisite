<?php
require_once '../php/db.php';
require_once '../php/function.php';
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
  header("Location: login.php");
}

$datas = get_all_member();


 ?>


<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>會員管理</title>
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
    <?php include_once 'menu.php';  ?>


    <!-- 網站內容 -->
    <div class="main">
      <div class="container">
          <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
          <div class="row ">
            <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
            <div class="col-xs-12 col-sm-12" style=" height:60px">
                <a href="member_add.php" class="btn btn-primary btn-lg">新增會員</a>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12">
              <table class="table table-hover table-dark ">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">帳號</th>
                      <th scope="col">名稱</th>
                      <th scope="col">管理動作</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($datas)): ?>
                    <?php foreach ($datas as $a_data): ?>
                        <tr >
                          <th scope="row"><?php echo $a_data['id']; ?></th>
                          <td ><?php echo $a_data['username']; ?></td>
                          <td ><?php echo $a_data['name']; ?></td>
                          <td >
                            <a class="btn btn-light" href="member_edit.php?i=<?php echo $a_data['id'];?>">編輯</a>
                            <a class="btn btn-danger del_member" href="javascript:void(0);" data-id="<?php echo $a_data['id'];?>">刪除會員</a>
                          </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                          <td colspan="4">無資料</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>

    <!-- 頁底 -->
    <?php include_once 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
      $(document).on("ready",function(){

        $("a.del_member").on("click",function(){
          var c = confirm("請確認是否刪除?");
          this_tr = $(this).parent().parent();

          if(c){
            $.ajax({
              type : "POST",	//表單傳送的方式 同 form 的 method 屬性
              url : "../php/del_member.php",  //目標給哪個檔案 同 form 的 action 屬性
              data : {	//為要傳過去的資料，使用物件方式呈現，因為變數key值為英文的關係，所以用物件方式送。ex: {name : "輸入的名字", password : "輸入的密碼"}
                'id' : $(this).attr("data-id")
              },
              dataType : 'html' //設定該網頁回應的會是 html 格式
            }).done(function(data) {
              if(data == "yes")
              {
                alert("刪除成功，點擊確認移除資料");
                this_tr.fadeOut();
              }
              else
              {
                alert("刪除失敗"+data);
              }

            }).fail(function(jqXHR, textStatus, errorThrown) {
              //失敗的時候
              alert("有錯誤產生，請看 console log");
              console.log(jqXHR.responseText);
            });
          }
        });
      });
    </script>


    <?php
    //結束mysql連線
    //mysql_close();
    ?>
  </body>
</html>
