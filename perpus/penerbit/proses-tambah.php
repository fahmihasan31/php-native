<?php
if($_POST) {
    include '../config/database.php';
    include '../object/Penerbit.php';

    $database = new Database();
    $db = $database->getConnection();

    $penerbit = new Penerbit($db);

    $penerbit->NamaPenerbit = $_POST['namapenerbit'];
    $penerbit->NoTelp = $_POST['notelp'];
    $penerbit->Alamat = $_POST['alamat'];
    
    if ($penerbit->create() == true) {
        header("Location: http://localhost/perpus/penerbit/index.php");
    }else {
        echo $exception->getMessage();
    }
}

?>