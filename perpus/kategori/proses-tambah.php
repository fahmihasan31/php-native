<?php
if($_POST) {
    include '../config/database.php';
    include '../object/Kategori.php';

    $database = new Database();
    $db = $database->getConnection();

    $kategori = new Kategori($db);

    $kategori->NamaKategori = $_POST['namakategori'];
    
    if ($kategori->create() == true) {
        header("Location: http://localhost/perpus/kategori/index.php");
    }else {
        echo $exception->getMessage();
    }
}

?>