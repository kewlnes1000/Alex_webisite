<?php
require_once 'db.php';
require_once 'function.php';

$check =update_user($_POST[id],$_POST[u],$_POST[pw],$_POST[n]);

if($check){
  echo 'yes';
}
else{
  echo 'no';
}

 ?>
