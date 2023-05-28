<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('includes/config.php');
require_once($BASE_ROOT_FOLDER_PATH . 'includes/database.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/Client.php');
require($BASE_ROOT_FOLDER_PATH . 'classes/DocumentType.php');


$client = new Client();
$registros = $client->getAll();

$document_type = new DocumentType();
$document_type_list = $document_type->getAll();

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
    <title>Gestion de clientes</title>
    <script src="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>js/actionsClients.js"></script>
    <link rel="stylesheet" href="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>css/bootstrap.min.css">
    <script src="<?php echo $BASE_ROOT_URL_PATH . 'assets/'; ?>js/bootstrap.min.js"></script>
</head>

<body>
    <br>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="fw-bolder fs-3">Registrar Cliente</span>
            </div>
        </div>

        <div class="row">
            <div class="span12">&nbsp;</div>
        </div>

        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="fw-bolder fs-4">Datos del cliente</span>
            </div>
        </div>

        <div class="row">
            <div class="span12">&nbsp;</div>
        </div>

        <form class="row g-3 align-items-center" action="<?php echo $BASE_ROOT_URL_PATH; ?>includes/client/save.php"
            method="post">

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Nombre</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="name" placeholder="Ingrese nombre" required>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Apellido</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="lastname" placeholder="Ingrese el apellido" required>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Dirección</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="address" placeholder="Ingrese la dirección" required>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Teléfono</label>
                <div class="col-6">
                    <input type="number" class="form-control" name="phone" placeholder="Ingrese el teléfono" required>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Tipo de documento:</label>
                <div class="col-6">
                    <select name="document_type">
                        <?php
                        foreach ($document_type_list as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Numero de documento</label>
                <div class="col-6">
                    <input type="number" class="form-control" name="document"
                        placeholder="Ingrese el número de documento" required>
                </div>
            </div>

            <div class="px-4 py-2 row">
                <label for="name" class="col-6 col-form-label fw-bolder">Email</label>
                <div class="col-6">
                    <input type="email" class="form-control" name="email" placeholder="Ingrese el correo" required>
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
                <a href="products.php"><input class="btn btn-primary" type="button" name="btn-products"
                        id="btn-products" value="Gestionar Productos"></a>
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
                <span class="fs-4">Tabla de clientes</span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle" id="edit-table">
                    <thead class="table-light">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Diección</th>
                        <th>Teléfono</th>
                        <th>Documento</th>
                        <th>Tipo de documento</th>
                        <th>Email</th>
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
                                $documentName = ($document_type->getById($fila['document_type'])['name']);
                        ?>
                        <tr>
                            <td>
                                <?php echo $fila['id'] ?>
                            </td>
                            <td>
                                <?php echo $fila['name'] ?>
                            </td>
                            <td>
                                <?php echo $fila['lastname'] ?>
                            </td>
                            <td>
                                <?php echo $fila['address'] ?>
                            </td>
                            <td>
                                <?php echo $fila['phone'] ?>
                            </td>
                            <td>
                                <?php echo $fila['document'] ?>
                            </td>
                            <td>
                                <?php echo $documentName ?>
                            </td>
                            <td>
                                <?php echo $fila['email'] ?>
                            </td>
                            <td>
                                <input type="button" value="Borrar"
                                    onClick="borrar_cliente(<?php echo $fila['id']; ?>);">
                                <input type="button" value="Editar"
                                    onClick="editar_cliente(<?php echo $fila['id']; ?>);">
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