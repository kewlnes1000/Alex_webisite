<?php
require_once '../php/db.php';
require_once '../php/function.php';
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
  header("Location: login.php");
}

//$datas = get_all_article();


 ?>


<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>新增文章</title>
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
            <div class="col-xs-12 col-sm-12">
              <form id="article">
                <div class="form-group">
                  <label for="title">標題</label>
                  <input type="text" class="form-control" id="title"  placeholder="輸入標題">
                </div>
                <div class="form-group">
                  <label for="category">分類</label>
                  <select id="category" class="form-control">
                    <option value="新聞">新聞</option>
                    <option value="科技">科技</option>
                    <option value="心得">心得</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="content">內文</label>
                  <textarea id="content" class="form-control" rows="10"></textarea>
                </div>
                <div class="form-group " >
                  <label for="content">圖片上傳</label>
                  <label class="form-control col-xs-6 col-sm-6" ><input type="file" class="image" accept="image/gif,image/jpeg,image/png"></label>
                  <input type="hidden" id="image_path" value="">
                  <div class="show_image"></div>
                  <a href="javascript:void(0)" class="del_image btn btn-default">刪除圖片</a>
                </div>
                <div class="form-group">
                  <label class="radio-inline">
                    <input type="radio" name="publish" value="1" checked> 發布
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="publish" value="0"> 不發布
                  </label>
                </div>
                <button type="submit" class="btn btn-primary">存檔</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <!-- 頁底 -->
    <?php include_once 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
      $(document).on("ready",function(){
          //圖片選擇後自動上傳
          $("input.image").on("change",function(){
            var save_path = "images/",
            form_data = new FormData();
            file_data = $(this)[0].files[0];

            form_data.append("file",file_data);
            form_data.append("save_path",save_path);
            $.ajax({
              type : "POST",
              url : "../php/upload_file.php",
              data : form_data,
              cache : false,  //不要暫存
              processData : false, //只上傳檔案,不處理表單資訊
              contentType : false,  //送過去的內容,由FormData產生,所以設定false
              dataType : 'html'
            }).done(function(data){
              if(data == 'yes'){
                //顯示圖片
                $("div.show_image").html("<img style='width:800px' src='../"+save_path+file_data['name']+"'>");
                //將相對路徑放進input
                $("#image_path").val(save_path+file_data['name']);
              }
              else {
                console.log("data");
              }
            }).fail(function(jqXHR, textStatus, errorThrown) {
              //失敗的時候
              alert("有錯誤產生，請看 console log");
              console.log(jqXHR.responseText);
            });
          });

          //圖片刪除

          $("a.del_image").on("click",function(){

            if($("#image_path").val() !=''){
              var c = confirm("確認是否刪除?");
              if(c){
                $.ajax({
                  type : "POST",
                  url : "../php/del_file.php",
                  data : {
                    'file' : $("#image_path").val()
                  },
                  dataType : 'html'
                }).done(function(data){
                  if(data == 'yes'){
                    //清除圖片
                    $("div.show_image").html("");
                    //將相對路徑清除
                    $("#image_path").val('');
                    //清除以選檔案
                    $("input.image").val('');
                  }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                  //失敗的時候
                  alert("有錯誤產生，請看 console log");
                  console.log(jqXHR.responseText);
                });
              }
            }
            else {
              alert("尚未上傳，無法刪除");
            }

          });


        $("#article").on("submit",function(){
            if ($("#title").val() == '' || $("#content").val() == '') {
              alert("請填寫標題或內容");
            }
            else {
              $.ajax({
  			        type : "POST",	//表單傳送的方式 同 form 的 method 屬性
  			        url : "../php/add_article.php",  //目標給哪個檔案 同 form 的 action 屬性
  			        data : {	//為要傳過去的資料，使用物件方式呈現，因為變數key值為英文的關係，所以用物件方式送。ex: {name : "輸入的名字", password : "輸入的密碼"}
                  'title' : $("#title").val(),
                  'category' : $("#category").val(),
                  'content' : $("#content").val(),
                  'image_path' : $("#image_path").val(),
                  'publish' : $("input[name='publish']:checked").val(),
  			        },
  			        dataType : 'html' //設定該網頁回應的會是 html 格式
  			      }).done(function(data) {
                console.log(data);
  			        if(data == "yes")
  			        {
                  alert("新增成功，轉跳列表頁")
                  window.location.href="article_list.php";
  			        }
  			        else
  			        {
                  alert("新增失敗"+data);
  			        }

  			      }).fail(function(jqXHR, textStatus, errorThrown) {
  			      	//失敗的時候
  			      	alert("有錯誤產生，請看 console log");
  			        console.log(jqXHR.responseText);
  			      });
            }

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
