<?php	
	session_start();	
	
	if (isset($_SESSION["cita"])) {
		$cita = $_SESSION["cita"];
		unset($_SESSION["cita"]);
		
		require_once("gestionBD.php");
		require_once("gestionarCitas.php");

		$conexion = crearConexionBD();		

		if(esConsulta($conexion,$oidcita)===TRUE){

			$excepcion = eliminar_consulta_por_cita($conexion,$oidcita);

			cerrarConexionBD($conexion);

		}else{

			$excepcion = eliminar_peluqueria_por_cita($conexion,$oidcita);

			cerrarConexionBD($conexion);


		}
		
		
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_citas_gestor.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consulta_citas_gestor.php");
	}
	else Header("Location: consulta_citas_gestor.php"); // Se ha tratado de acceder directamente a este PHP
?>