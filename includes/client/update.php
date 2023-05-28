<?php
  require_once (getcwd() . '/../config.php');
  require_once ($BASE_ROOT_FOLDER_PATH.'includes/database.php');
  require($BASE_ROOT_FOLDER_PATH.'classes/Client.php');
  
  if(!empty($_POST['name'])){
    
    $client = new Client();
    $client->update($_POST['id'], $_POST['name'], $_POST['lastname'], $_POST['address'], $_POST['phone'], $_POST['document'], $_POST['document_type'],$_POST['email']);
  }

  header('Location: '.$BASE_ROOT_URL_PATH.'clients.php'); 
  exit;