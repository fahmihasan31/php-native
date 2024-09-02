<?php
if($_GET["ID"]) {
    include '../config/database.php';
    include '../object/Petugas.php';

    $database = new Database();
    $db = $database->getConnection();

    $petugas = new Petugas($db);
    $petugas->ID = $_GET['ID'];

    if($petugas->delete() == true){
        header("Location: http://localhost/perpus/petugas/index.php");
    }else {
        echo $exception->getMessage();
    }
}
?>