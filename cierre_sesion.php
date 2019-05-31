<?php
	session_start();
    
    if (isset($_SESSION['login'])){
        unset($_SESSION['login']);
        header("Location: inicio.php");
    }
    if (isset($_SESSION['loginTrabajador'])){
        unset($_SESSION['loginTrabajador']);
        header("Location: inicio.php");
    }
    if (isset($_SESSION['loginGestor'])){
        unset($_SESSION['loginGestor']);
        header("Location: inicio.php");
    }
?>
