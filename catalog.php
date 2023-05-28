<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('includes/config.php');
require_once($BASE_ROOT_FOLDER_PATH . 'includes/database.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Product.php');


$product = new Product();
$registros = $product->getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>css/bootstrap.min.css">
    <script src="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>css/catalogStyle.css" />
    <title>Catálogo de productos</title>
</head>

<body>
    <div class='contenedor'>
        <div class="header text-center">
            <div class="thead"><h2>Catálogo de productos</h2></div>
            <div class="button"><a href="index.php"><input class="btn btn-primary" type="button" name="btn-sell" id="btn-sell" value="Vender"></a></div>
        </div>
        <div class="products">
            <?php
                if(count($registros) < 1){
            ?>
                    <div><h3>No hay productos disponibles en la tienda</h3></div>
            <?php
                } else {
                    foreach ($registros as $row) {
                
            ?>
                        <div class="product">
                            <div class="tittle"><?php echo $row['name']?></div>
                            <div class="details"><?php echo $row['details']?></div>
                            <div class="price">$<?php echo $row['price']?></div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</body>

</html>