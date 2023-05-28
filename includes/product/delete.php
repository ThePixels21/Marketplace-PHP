<?php
    require_once (getcwd() . '/../config.php');
    require_once ($BASE_ROOT_FOLDER_PATH.'includes/database.php');
    require($BASE_ROOT_FOLDER_PATH.'classes/Product.php');
    $id = $_GET['id'];

    $product = new Product();

    $product->delete($id);

    header('Location: '.$BASE_ROOT_URL_PATH.'products.php'); // Forma de redireccionar hacia la pagina principal (index.php)
    exit;