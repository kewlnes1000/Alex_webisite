<?php
//print_r($_FILES);
//echo '<hr>';
//print_r($_POST);


if(file_exists($_FILES['file']['tmp_name'])){
  $img_folder = $_POST['save_path']; //定義上傳的資料夾
  $file_name = $_FILES['file']['name'];


  if(move_uploaded_file($_FILES['file']['tmp_name'],"../" . $img_folder . $file_name)){
    echo "yes";
  }
  else {
    echo "檔案搬移失敗，請確認{$_POST['save_path']}資料夾可寫入";
  }
}
else {
  echo "檔案不存在，上傳失敗";
}

 ?>
