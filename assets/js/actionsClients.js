function borrar_cliente(id) {
  if (confirm("Está seguro de eliminar el registro?")) {
    location.replace(BASE_ROOT_URL_PATH + 'includes/client/delete.php?id=' + id);
  }
}

function editar_cliente(id) {
  location.replace(BASE_ROOT_URL_PATH + 'includes/client/edit.php?id=' + id);
}