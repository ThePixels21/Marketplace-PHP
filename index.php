<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('includes/config.php');
require_once($BASE_ROOT_FOLDER_PATH . 'includes/database.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Sale.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Product.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Client.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Company.php');


$sale = new Sale();
$sales = $sale->getAll();

$product = new Product();
$products = $product->getAll();

$client = new Client();
$clients = $client->getAll();

$company = new Company();
$companys = $company->getAll();

session_start();
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = array();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Gestion de ventas</title>
    <script src="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>js/actionsSale.js"></script>
    <link rel="stylesheet" href="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>css/bootstrap.min.css">
    <script src="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>js/bootstrap.min.js"></script>
</head>

<body>
    <br>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="fw-bolder fs-3">Registrar Venta</span>
            </div>
        </div>

        <div class="row">
            <div class="span12">&nbsp;</div>
        </div>

        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="fw-bolder fs-4">Datos de la venta</span>
            </div>
        </div>

        <div class="row">
            <div class="span12">&nbsp;</div>
        </div>

        <form class="row g-3 align-items-center" action="<?php echo $BASE_ROOT_URL_PATH; ?>includes/sale/save.php"
            method="post">

            <div class="px-4 py-2 row">
                <label for="name" class="col-3 col-form-label fw-bolder">Producto:</label>
                <div class="col-3">
                    <select name="product">
                        <?php
                        foreach ($products as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-2">
                    <input type="number" class="form-control" name="amount" placeholder="Cantidad">
                </div>
                <div class="col-2">
                    <input type="submit" class="form-control btn btn-primary" name="add" value="Añadir">
                </div>
                <div class="col-2">
                    <input type="submit" class="form-control btn btn-primary" name="delete" value="Eliminar todos">
                </div>
            </div>
        </form>
        <div class="row align-items-center" id="show-content">
            <div class="col-12 text-center">
                <span class="fs-4">Productos añadidos</span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle" id="edit-table">
                    <thead class="table-light">
                        <th>Producto</th>
                        <th>Cantidad</th>
                    </thead>
                    <tbody>
                        <?php
                        if (count($_SESSION['products']) < 1) {
                        ?>
                        <tr>
                            <td colspan="2">No hay productos</td>
                        </tr>
                        <?php
                        } else {

                            foreach ($_SESSION['products'] as $prod => $value) {
                                $productName = ($product->getById($value['product'])['name']);
                        ?>
                        <tr>
                            <td>
                                <?php echo $productName ?>
                            </td>
                            <td>
                                <?php echo $value['amount'] ?>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <form class="row g-3 align-items-center" action="<?php echo $BASE_ROOT_URL_PATH; ?>includes/sale/save.php"
            method="post">

            <div class="px-4 py-2 row">
                <label for="name" class="col-5 col-form-label fw-bolder">Empresa:</label>
                <div class="col-7">
                    <select name="company">
                        <?php
                        foreach ($companys as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-5 col-form-label fw-bolder">Cliente:</label>
                <div class="col-7">
                    <select name="client">
                        <?php
                        foreach ($clients as $row) {
                            $name = $row['name'] . ' ' . $row['lastname'];
                            echo '<option value="' . $row['id'] . '">' . $name . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <div class="col-3">&nbsp;</div>
                <div class="col-6">
                    <input type="submit" class="form-control btn btn-primary" name="upload" value="Finalizar">
                </div>
                <div class="col-3">&nbsp;</div>
            </div>
        </form>

        <div class="row text-center align-items-center">
            <div class="col-4">
                <a href="clients.php"><input class="btn btn-primary" type="button" name="btn-clients" id="btn-clients"
                        value="Gestionar Clientes"></a>
            </div>
            <div class="col-4">
                <a href="products.php"><input class="btn btn-primary" type="button" name="btn-products"
                        id="btn-products" value="Gestionar Productos"></a>
            </div>
            <div class="col-4">
                <a href="catalog.php"><input class="btn btn-primary" type="button" name="btn-catalog" id="btn-catalog"
                        value="Ver el Catálogo"></a>
            </div>
        </div>


        <div class="row align-items-center" id="show-content">
            <div class="col-12 text-center">
                <span class="fs-4">Tabla de ventas</span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle" id="edit-table">
                    <thead class="table-light">
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Factura</th>
                    </thead>
                    <tbody>
                        <?php
                        if (count($sales) < 1) {
                        ?>
                        <tr>
                            <td colspan="4">No hay registros</td>
                        </tr>
                        <?php
                        } else {

                            foreach ($sales as $fila) {
                                $companyName = ($company->getById($fila['company_id'])['name']);
                                $clientName = ($client->getById($fila['client_id'])['name']);
                                $clientLastName = ($client->getById($fila['client_id'])['lastname']);
                        ?>
                        <tr>
                            <td>
                                <?php echo $fila['id'] ?>
                            </td>
                            <td>
                                <?php echo $companyName ?>
                            </td>
                            <td>
                                <?php echo $clientName . ' ' . $clientLastName ?>
                            </td>
                            <td>
                                <?php echo $fila['date'] ?>
                            </td>
                            <td>
                                <input type="button" value="Factura"
                                    onClick="show_receipt(<?php echo $fila['id']; ?>);">
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>