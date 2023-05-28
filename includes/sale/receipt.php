<?php
require_once(getcwd() . '/../config.php');
require_once($BASE_ROOT_FOLDER_PATH . 'includes/database.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Sale.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Product.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/ProductSold.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Client.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Company.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/DocumentType.php');

$id = $_GET['id'];

$objectSale = new Sale();
$sale = $objectSale->getById($id);

$objectClient = new Client();
$client = $objectClient->getById($sale['client_id']);

$objectDocument = new DocumentType();
$document = $objectDocument->getById($client['document_type']);

$objectCompany = new Company();
$company = $objectCompany->getById($sale['company_id']);

$objectProductSold = new ProductSold();
$products = $objectProductSold->getAllProductsBySale($id);

$objectProduct = new Product();

$totalPrice = 0;
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
    <title>Recibo de venta</title>
    <script src="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>js/actionsSale.js"></script>
    <link rel="stylesheet" href="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>css/bootstrap.min.css">
    <script src="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>js/bootstrap.min.js"></script>
</head>

<body>
    <div class="bg-light container-fluid">
        <div class="row">
            <div class="col-6 display-4 text-primary">Factura #
                <?php echo $id ?>
            </div>
            <div class="col-6 display-4 text-end text-muted">
                <?php echo $sale['date'] ?>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-tittle">Datos de la empresa</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 h5">Nombre:
                                <?php echo $company['name'] ?>
                            </div>
                            <div class="col-4 h5">Dirección:
                                <?php echo $company['address'] ?>
                            </div>
                            <div class="col-4 h5">Nit:
                                <?php echo $company['nit'] ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-4 h5">Correo:
                                <?php echo $company['email'] ?>
                            </div>
                            <div class="col-4 h5">Telefono:
                                <?php echo $company['phone'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-tittle">Datos del cliente</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 h5">Nombre:
                                <?php echo $client['name'] ?>
                            </div>
                            <div class="col-4 h5">Tipo de documento:
                                <?php echo $document['name'] ?>
                            </div>
                            <div class="col-4 h5">Documento:
                                <?php echo $client['document'] ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-4 h5">Dirección:
                                <?php echo $client['address'] ?>
                            </div>
                            <div class="col-4 h5">Telefono:
                                <?php echo $client['phone'] ?>
                            </div>
                            <div class="col-4 h5">Correo:
                                <?php echo $client['email'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-tittle">Productos adquiridos</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>Precio unitario</th>
                                <th>Precio total</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($products as $row) {
                                    $productName = ($objectProduct->getById($row['product_id'])['name']);
                                    $productPrice = ($objectProduct->getById($row['product_id'])['price']);
                                    $amount = $row['amount'];
                                    $totalPriceProduct = $productPrice * $amount;
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $amount ?>
                                    </td>
                                    <td>
                                        <?php echo $productName ?>
                                    </td>
                                    <td>
                                        <?php echo $productPrice ?>
                                    </td>
                                    <td>
                                        <?php echo $totalPriceProduct ?>
                                    </td>
                                </tr>
                                <?php
                                    $totalPrice += $totalPriceProduct;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="card-tittle">Precio total</h3>
                            </div>
                            <div class="col-6">
                                <h3 class="text-end">$
                                    <?php echo $totalPrice ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-3">&nbsp;</div>
            <div class="col-6 text-center">
                <a href="<?php echo $BASE_ROOT_URL_PATH . 'index.php' ?>">
                    <input type="button" class="form-control btn btn-primary" name="back" value="Volver">
                </a>
            </div>
            <div class="col-3">&nbsp;</div>
        </div>
    </div>
</body>

</html>