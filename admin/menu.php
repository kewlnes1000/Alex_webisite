
<?php
$file_path = $_SERVER['PHP_SELF'];
$file_name = basename($file_path,".php");

switch ($file_name) {
  case 'article_list':
  case 'article_edit':
  case 'article_add':
    $page_index =1;
    break;
  case 'member_list':
  case 'member_edit':
  case 'member_add':
    $page_index =3;
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

          <h1 class="text-center" style="width: 1000px;">Alex webisite  <span class="badge badge-secondary">New</span></h1>
          <!-- 選單 -->

          <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href='../index.php'>前台首頁</a></li>
                <li class="breadcrumb-item"<?php echo($page_index == 0)?"class='active' aria-current='page'":"" ?>><?php echo($page_index == 0)?"後台首頁":"<a href='../index.php'>後台首頁</a>"?></li>
                <li class="breadcrumb-item"<?php echo($page_index == 1)?"class='active' aria-current='page'":"" ?>><?php echo($page_index == 1)?"文章管理":"<a href='article_list.php'>文章管理</a>"?></li>
                <li class="breadcrumb-item"<?php echo($page_index == 3)?"class='active' aria-current='page'":"" ?>><?php echo($page_index == 3)?"會員管理":"<a href='member_list.php'>會員管理</a>"?></li>
                <li class="breadcrumb-item"><a href='../php/logout.php'>登出</a></li>
              </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
