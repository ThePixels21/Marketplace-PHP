<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $BASE_ROOT_FOLDER_PATH = 'C:/xampp/htdocs/market/';
    $BASE_ROOT_URL_PATH = 'http://localhost/market/';
?>

<script>
    let BASE_ROOT_URL_PATH = '<?php echo $BASE_ROOT_URL_PATH; ?>';
</script>