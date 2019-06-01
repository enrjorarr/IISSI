<?php	
	session_start();	
	
	if (isset($_SESSION["petcita"])) {
		$cita = $_SESSION["petcita"];
		unset($_SESSION["petcita"]);
		
		require_once("gestionBD.php");
		require_once("gestionarPetCitas.php");
		
		$conexion = crearConexionBD();		
		$excepcion = quitar_libro($conexion,$cita["OIDPETCITA"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_citas_gestor.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consulta_citas_gestor.php");
	}
	else Header("Location: consulta_citas_gestor.php"); // Se ha tratado de acceder directamente a este PHP
?>