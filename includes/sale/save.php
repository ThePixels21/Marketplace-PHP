<?php
require_once(getcwd() . '/../config.php');
require_once($BASE_ROOT_FOLDER_PATH . 'includes/database.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Sale.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/ProductSold.php');

session_start();
if (!isset($_SESSION['products'])) {
  $_SESSION['products'] = array();
}

if (isset($_POST['add'])) {
  if (!empty($_POST['amount']) && $_POST['amount'] > 0) {

    $prod = array(
      'amount' => $_POST['amount'],
      'product' => $_POST['product']
    );

    $_SESSION['products'][$_POST['product']] = $prod;
  }
}

if (isset($_POST['delete'])) {
  $_SESSION['products'] = array();
}

if (isset($_POST['upload'])) {

  if (count($_SESSION['products']) > 0) {
    $company = $_POST['company'];
    $client = $_POST['client'];

    $products = $_SESSION['products'];

    $sale = new Sale();
    $sale->save($company, $client);
    $sale_id = $sale->getLastIdByClient($client)['id'];

    $productSold = new ProductSold();

    foreach ($products as $product => $value) {
      $productSold->save($sale_id, $value['product'], $value['amount']);
    }

    $_SESSION['products'] = array();

    header('Location: ' . $BASE_ROOT_URL_PATH . '/includes/sale/receipt.php?id='.$sale_id);
    exit;
  }

}

header('Location: ' . $BASE_ROOT_URL_PATH . 'index.php');
exit;