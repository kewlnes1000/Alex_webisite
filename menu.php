
<?php
$file_path = $_SERVER['PHP_SELF'];
$file_name = basename($file_path,".php");

switch ($file_name) {
  case 'article_list':
    $page_index =1;
    break;
  case 'article':
    $page_index =1;
    break;
    case 'about':
    $page_index =3;
    break;
  case 'register':
    $page_index =4;
    break;
  default:
    $page_index = 0;
    break;
}

 ?>



<div class="jumbotron">
  <div class="container">
    <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
    <div class="row">
      <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
      <div class="col-xs-12">
        <!--網站標題-->

          <h1 class="text-center" style="width: 1000px;">Alex   <span class="badge badge-secondary">webisite</span></h1>
          <!-- 選單 -->

          <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"<?php echo($page_index == 0)?"class='active' aria-current='page'":"" ?>><?php echo($page_index == 0)?"首頁":"<a href='index.php'>首頁</a>"?></li>
                <li class="breadcrumb-item"<?php echo($page_index == 1)?"class='active' aria-current='page'":"" ?>><?php echo($page_index == 1)?"所有文章":"<a href='article_list.php'>所有文章</a>"?></li>
                <li class="breadcrumb-item"<?php echo($page_index == 3)?"class='active' aria-current='page'":"" ?>><?php echo($page_index == 3)?"關於我們":"<a href='about.php'>關於我們</a>"?></li>
                <li class="breadcrumb-item"<?php echo($page_index == 4)?"class='active' aria-current='page'":"" ?>><?php echo($page_index == 4)?"註冊":"<a href='register.php'>註冊</a>"?></li>
                <li class="breadcrumb-item"><a href='admin/index.php'>登入</a></li>
              </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
