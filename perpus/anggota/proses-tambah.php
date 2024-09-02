<?php
if($_POST) {
    include '../config/database.php';
    include '../object/Anggota.php';

    $database = new Database();
    $db = $database->getConnection();

    $anggota = new Anggota($db);

    $anggota->NIK = $_POST['nik'];
    $anggota->NamaLengkap = $_POST['namalengkap'];
    $anggota->Alamat = $_POST['alamat'];
    $anggota->NoTelp = $_POST['notelp'];
    $anggota->TglLahir = $_POST['tgllahir'];
    
    if ($anggota->create() == true) {
        header("Location: http://localhost/perpus/anggota/index.php");
    }else {
        echo $exception->getMessage();
    }
}

?>