<?php 
    session_start();
    if (!isset($_SESSION['IDUsuario'])) {
        header("location: index.php");
        exit();
    }
?>

<div> SEJA BEM VINDO! </div>