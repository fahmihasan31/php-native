<?php
session_start();

if(isset($_SESSION["idpetugas"])) {

    $_SESSION = array();

    session_destroy();
}
header("Location: http://localhost/perpus/dashboard.php");
?>