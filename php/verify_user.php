<?php
require_once 'db.php';
require_once 'function.php';

$check = verify_user($_POST['u'],$_POST['pw']);

if($check){
  echo 'yes';
}
else{
  echo 'no';
}

 ?>
