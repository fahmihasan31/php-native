<?php
if($_GET["ID"]) {
    include '../config/database.php';
    include '../object/Anggota.php';

    $database = new Database();
    $db = $database->getConnection();

    $anggota = new Anggota($db);
    $anggota->ID = $_GET['ID'];

    if($anggota->delete() == true){
        header("Location: http://localhost/perpus/anggota/index.php");
    }else {
        echo $exception->getMessage();
    }
}
?>