<?php
  require_once (getcwd() . '/../config.php');
  require_once ($BASE_ROOT_FOLDER_PATH.'includes/database.php');
  require($BASE_ROOT_FOLDER_PATH.'classes/Product.php');
  
  if(!empty($_POST['name'])){
    
    $product = new Product();
    $product->update( $_POST['id'], $_POST['name'], $_POST['nup'], $_POST['maker_id'], $_POST['category_id'], $_POST['price'], $_POST['details']);
  }

  header('Location: '.$BASE_ROOT_URL_PATH.'products.php'); 
  exit;