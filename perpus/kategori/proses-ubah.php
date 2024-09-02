<?php
if($_GET["ID"]) {
    include '../config/database.php';
    include '../object/kategori.php';

    $database = new Database();
    $db = $database->getConnection();

    $kategori = new Kategori($db);
    $kategori->ID = $_GET['ID'];
    $kategori->NamaKategori = $_GET['NamaKategori'];

    if($kategori->update() == true){
        header("Location: http://localhost/perpus/kategori/index.php");
    }else {
        echo $exception->getMessage();
    }
}
?>