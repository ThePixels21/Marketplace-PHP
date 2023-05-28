<?php
    require_once (getcwd() . '/../config.php');
    require_once ($BASE_ROOT_FOLDER_PATH.'includes/database.php');
    require($BASE_ROOT_FOLDER_PATH.'classes/Client.php');
    $id = $_GET['id'];

    $cliente = new Client();

    $cliente->delete($id);

    header('Location: '.$BASE_ROOT_URL_PATH.'clients.php');
    exit;