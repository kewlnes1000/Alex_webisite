<?php
require_once 'php/db.php';
require_once 'php/function.php';

$article = get_article($_GET['p']);



?>

<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title><?php echo $article['title']; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name ="description" content="Alex 測試作品網站!">
    <meta name ="author" content="Alex">
    <!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/titleico.png">

    <link rel="stylesheet" href="css/style.css">

  </head>

  <body>
    <!-- 頁首 -->
    <?php include_once 'menu.php'; ?>

    <!-- 網站內容 -->
    <div class="main">
      <div class="content">
        <div class="container">
          <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
          <div class ="row">
            <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
            <div class = "col-xs-12">
                <h1><?php echo $article['title']; ?></h1>
                <hr>
                <?php echo $article['content']; ?>
                </hr>
                <img class="img-thumbnail rounded mx-auto d-block" style="width:800px"  src="<?php echo $article['images']; ?>" >
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- 頁底 -->
    <?php include_once 'footer.php'; ?>
    <?php
    //結束mysql連線
    //mysql_close();
    ?>
  </body>
</html>
