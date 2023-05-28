<?php
  require_once (getcwd() . '/../config.php');
  require_once ($BASE_ROOT_FOLDER_PATH.'includes/database.php');
  require($BASE_ROOT_FOLDER_PATH.'classes/Client.php');
  
  if(!empty($_POST['name'])){
    
    $client = new Client();

    $name =  $_POST['name'];
    $lastname =  $_POST['lastname'];
    $address =  $_POST['address'];
    $phone =  $_POST['phone'];
    $document =  $_POST['document'];
    $document_type =  $_POST['document_type'];
    $email =  $_POST['email'];

    $client->save($name, $lastname, $address, $phone, $document, $document_type, $email);

  }

  header('Location: '.$BASE_ROOT_URL_PATH.'clients.php'); // Forma de redireccionar hacia la pagina principal (index.php)
  exit;