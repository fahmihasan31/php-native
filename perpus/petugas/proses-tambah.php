<?php
if($_POST) {
    include '../config/database.php';
    include '../object/Petugas.php';

    $database = new Database();
    $db = $database->getConnection();

    $petugas = new Petugas($db);

    $petugas->Username = $_POST['username'];
    $petugas->Email = $_POST['email'];
    $petugas->Password = $_POST['password'];
    $petugas->Role = $_POST['role'];
    
    if ($petugas->create() == true) {
        header("Location: http://localhost/perpus/petugas/index.php");
    }else {
        echo $exception->getMessage();
    }
}

?>