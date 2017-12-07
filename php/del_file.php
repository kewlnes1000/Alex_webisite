<?php
//若檔案存在糾刪除

if(file_exists("../" . $_POST['file'])){
  if(unlink("../" . $_POST['file'])){
    echo "yes";
  }
  else {
    echo "no";
  }
}
else {
  echo "檔案不存在";
}


 ?>
