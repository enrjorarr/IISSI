<?php
	session_start();
  	
  	include_once("gestionBD.php");
    include_once("gestionarClientes.php");
    include_once("gestionarTrabajadores.php");
	
	if (isset($_POST['submit'])){
		$email= $_POST['email'];
		$pass = $_POST['pass'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarUsuario($conexion,$email,$pass);
		cerrarConexionBD($conexion);	
	
		if ($num_usuarios == 0){
			$login = "error";	
			//Header("Location: inicio.php");
		}
		else {
			$_SESSION['login'] = $email;
			Header("Location: /inicio.php");
        }	
        
	}
	elseif (isset($_POST['submit'])){

        $email= $_POST['email'];
		$pass = $_POST['pass'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarTrabajadores($conexion,$email,$pass);
		cerrarConexionBD($conexion);
			
        if ($num_usuarios == 0){
			$login = "error";	
		}	
        else {
            $_SESSION['login'] = $email;
            Header("Location: index_trabajador.php");}
	}
	else{
        if ($num_usuarios == 0)
            $login = "error";	
        else {
             $_SESSION['login'] = $email;
             Header("Location: inicio_sesion.php");
	}
    }

?>
