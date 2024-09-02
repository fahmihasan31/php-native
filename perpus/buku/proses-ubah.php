<?php

if($_POST) {
    include '../config/database.php';
    include '../object/Buku.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $buku = new Buku($db);
    
    $buku->ISBN = $_POST['isbn'];
    $buku->Judul = $_POST['judul'];
    $buku->Pengarang = $_POST['pengarang'];
    $buku->Kategori_ID = $_POST['kategori_id'];
    $buku->Penerbit_ID = $_POST['penerbit_id'];
    $buku->Deskripsi = $_POST['deskripsi'];
    $buku->Stok = $_POST['stok'];
    $buku->ID = $_POST['id'];

    if ($buku->update() == true) {
        header("Location: http://localhost/perpus/buku/index.php");
    }else {
        echo $exception->getMessage();
    }


}