<?php
require_once 'db.php';
require_once 'function.php';



$check = add_article($_POST['title'],$_POST['category'],$_POST['content'],$_POST['publish'],$_POST['image_path']);

if($check){
  echo 'yes';
}
else{
  echo 'no';
}

 ?>
