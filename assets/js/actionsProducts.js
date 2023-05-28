function borrar_producto(id) {
    if (confirm("Está seguro de eliminar el producto?")) {
        location.replace(BASE_ROOT_URL_PATH + 'includes/product/delete.php?id=' + id);
    }
}

function editar_producto(id) {
    location.replace(BASE_ROOT_URL_PATH + 'includes/product/edit.php?id=' + id);
}