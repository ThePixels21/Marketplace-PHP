<?php
  require_once (getcwd() . '/../config.php');
  require_once ($BASE_ROOT_FOLDER_PATH.'includes/database.php');
  require($BASE_ROOT_FOLDER_PATH.'classes/Product.php');

  if(!empty($_POST['name'])){
    
    $product = new Product();
                  
      $name =  $_POST['name'];
      $nup =  $_POST['nup'];
      $maker_id =  $_POST['maker_id'];
      $category_id =  $_POST['category_id'];
      $details =  $_POST['details'];
      $price =  $_POST['price'];

      $product->save($name, $nup, $maker_id, $category_id, $price, $details);
  }

  header('Location: '.$BASE_ROOT_URL_PATH.'products.php'); // Forma de redireccionar hacia la pagina principal (index.php)
  exit;