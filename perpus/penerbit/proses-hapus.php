<?php
if($_GET["ID"]) {
    include '../config/database.php';
    include '../object/Penerbit.php';

    $database = new Database();
    $db = $database->getConnection();

    $penerbit = new Penerbit($db);
    $penerbit->ID = $_GET['ID'];

    if($penerbit->delete() == true){
        header("Location: http://localhost/perpus/penerbit/index.php");
    }else {
        echo $exception->getMessage();
    }
}
?>