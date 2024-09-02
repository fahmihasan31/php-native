<?php
if($_GET["ID"]) {
    include '../config/database.php';
    include '../object/Buku.php';

    $database = new Database();
    $db = $database->getConnection();

    $buku = new Buku($db);
    $buku->ID = $_GET['ID'];

    if($buku->delete() == true){
        header("Location: http://localhost/perpus/buku/index.php");
    }else {
        echo $exception->getMessage();
    }
}
?>