<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionarClientes.php");
	
	if (isset($_POST['submit'])){
		$email= $_POST['email'];
		$pass = $_POST['pass'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarClientes($conexion,$email,$pass);
		cerrarConexionBD($conexion);	
	
		if ($num_usuarios == 0)
			$login = "error";	
		else {
			$_SESSION['login'] = $email;
			Header("Location: include/index.php");
		}	
	}

?>
