<?php
session_start();


if($_POST) {
   include '../config/database.php';
   include '../object/Petugas.php';
   
   $database = new Database();
   $db = $database->getConnection();

   $petugas = new Petugas($db);

   $petugas->Email = $_POST["email"];
   $petugas->Password = $_POST["password"];

   if($petugas->authenticate()) {
    header("Location: http://localhost/perpus/dashboard.php");
   } else {
    header("Location: http://localhost/perpus/login/index.php");
   }

}