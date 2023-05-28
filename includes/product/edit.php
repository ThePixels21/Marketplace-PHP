<?php
require_once (getcwd() . '/../config.php');
require_once($BASE_ROOT_FOLDER_PATH . 'includes/database.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Product.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/ProductMaker.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/ProductCategory.php');

$id = $_GET['id'];

$product = new Product();
$datos = $product->getById($id);

$makers = new ProductMaker();
$maker_list = $makers->getAll();

$categories = new ProductCategory();
$category_list = $categories->getAll();

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
    <title>Editar producto</title>
    <link rel="stylesheet" href="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>css/bootstrap.min.css">
    <script src="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>css/style.css" />
</head>

<body>
    <br>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="fw-bolder fs-3">Editar Producto</span>
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

        <form class="row g-3 align-items-center" action="<?php echo $BASE_ROOT_URL_PATH; ?>includes/product/update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">
            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Nombre</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $datos['name']; ?>" placeholder="Ingrese nombre" required>
                </div>
            </div>
            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">nup</label>
                <div class="col-6">
                    <input type="number" class="form-control" name="nup" value="<?php echo $datos['nup']; ?>" placeholder="Ingrese el numero unico del producto">
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
                <label for="name" class="col-6 col-form-label fw-bolder">Categorias:</label>
                <div class="col-6">
                    <select name="category_id">
                        <?php
                        foreach ($category_list  as $category) {
                            echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Detalles/Observaciones</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="details" value="<?php echo $datos['details']; ?>" placeholder="Ingrese correo electrónico">
                </div>
            </div>
            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Precio</label>
                <div class="col-6">
                    <input type="number" class="form-control" name="price" value="<?php echo $datos['price']; ?>" placeholder="Ingrese el precio del producto" require>
                </div>
            </div>
            <div class="px-4 py-2 row">
                <div class="col-3">&nbsp;</div>
                <div class="col-6">
                    <input type="submit" class="form-control btn btn-primary" name="submit" value="Actualizar" require>
                </div>
                <div class="col-3">&nbsp;</div>
            </div>
        </form>

        <br><br>
    </div>
</body>

</html>