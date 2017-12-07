<?php
require_once 'db.php';
require_once 'function.php';

$check =check_username($_POST[n]);

if($check){
  echo 'yes';
}
else{
  echo 'no';
}

 ?>
