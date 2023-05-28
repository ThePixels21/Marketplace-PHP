<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('includes/config.php');
require_once($BASE_ROOT_FOLDER_PATH . 'includes/database.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/ProductMaker.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/ProductCategory.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Product.php');

$product = new Product();
$registros = $product->getAll();

$objectMaker = new ProductMaker();
$maker_list = $objectMaker->getAll();

$objectCategory = new ProductCategory();
$category_list = $objectCategory->getAll();

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
    <title>Gestion de productos</title>
    <script src="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>js/actionsProducts.js"></script>
    <link rel="stylesheet" href="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>css/bootstrap.min.css">
    <script src="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>css/style.css" />
</head>

<body>
    <br>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="fw-bolder fs-3">Crear Producto</span>
            </div>
        </div>

        <div class="row">
            <div class="span12">&nbsp;</div>
        </div>

        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="fw-bolder fs-4">Datos del producto</span>
            </div>
        </div>

        <div class="row">
            <div class="span12">&nbsp;</div>
        </div>

        <form class="row g-3 align-items-center" action="<?php echo $BASE_ROOT_URL_PATH; ?>includes/product/save.php"
            method="post">

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Categorias:</label>
                <div class="col-6">
                    <select name="category_id">
                        <?php
                        foreach ($category_list as $category) {
                            echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Fabricantes:</label>
                <div class="col-6">
                    <select name="maker_id">
                        <?php
                        foreach ($maker_list as $maker) {
                            echo '<option value="' . $maker['id'] . '">' . $maker['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Nombre</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="name" placeholder="Ingrese nombre" required>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Número unico de producto</label>
                <div class="col-6">
                    <input type="number" class="form-control" name="nup" placeholder="Ingrese número unico de producto"
                        required>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Detalles/Observaciones</label>
                <div class="col-6">
                    <textarea name="details" id="" cols="50" rows="6"
                        placeholder="Ingrese detalles u observaciones"></textarea>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Precio</label>
                <div class="col-6">
                    <input type="number" class="form-control" name="price" placeholder="Ingrese el precio del producto"
                        required>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <div class="col-3">&nbsp;</div>
                <div class="col-6">
                    <input type="submit" class="form-control btn btn-primary" name="submit" value="Registrar" require>
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
                <a href="index.php"><input class="btn btn-primary" type="button" name="btn-products"
                        id="btn-products" value="Vender Productos"></a>
            </div>
            <div class="col-4">
                <a href="catalog.php"><input class="btn btn-primary" type="button" name="btn-catalog" id="btn-catalog"
                        value="Ver el Catálogo"></a>
            </div>
        </div>
        <div class="row align-items-center" id="show-content">
            <div class="col-12 text-center">
                <span class="fs-4">Tabla de productos</span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle" id="edit-table">
                    <thead class="table-light">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Nup</th>
                        <th>Maker</th>
                        <th>Category</th>
                        <th>Details</th>
                        <th>Price</th>
                        <th>Created at</th>
                    </thead>
                    <tbody>
                        <?php
                        if (count($registros) < 1) {
                        ?>
                        <tr>
                            <td colspan="8">No hay registros</td>
                        </tr>
                        <?php
                        } else {

                            foreach ($registros as $fila) {
                                $makerName = ($objectMaker->getById($fila['maker_id'])['name']);
                                $categoryName = ($objectCategory->getById($fila['category_id'])['name']);
                                
                        ?>
                        <tr>
                            <td>
                                <?php echo $fila['id'] ?>
                            </td>
                            <td>
                                <?php echo $fila['name'] ?>
                            </td>
                            <td>
                                <?php echo $fila['nup'] ?>
                            </td>
                            <td>
                                <?php echo $makerName ?>
                            </td>
                            <td>
                                <?php echo $categoryName ?>
                            </td>
                            <td>
                                <?php echo $fila['details'] ?>
                            </td>
                            <td>
                                <?php echo $fila['price'] ?>
                            </td>
                            <td>
                                <?php echo $fila['created_at'] ?>
                            </td>
                            <td>
                                <input type="button" value="Borrar"
                                    onClick="borrar_producto(<?php echo $fila['id']; ?>);">
                                <input type="button" value="Editar"
                                    onClick="editar_producto(<?php echo $fila['id']; ?>);">
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