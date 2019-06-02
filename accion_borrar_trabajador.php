<?php	
	session_start();	
	
	if (isset($_SESSION["trabajador"])) {

        $trabajador = $_SESSION["trabajador"];
        
		$oidtrabajador = $trabajador["OIDTRABAJADOR"];
		$dni = $trabajador["DNI"];

        unset($_SESSION["trabajador"]);
		
		require_once("gestionBD.php");
		require_once("gestionarTrabajadores.php");
	

        $conexion = crearConexionBD();	
	
		if(eliminar_trabajador($conexion,$dni)){
			
			Header("Location: consulta_trabajadores.php");

		}
 //       if(esVeterinario($conexion,$oidtrabajador)===TRUE){

			//Busqueda oid_veterinario
			
	//		$veterinario = consultarVeterinario2OIDTrabajador($conexion,$oidtrabajador);
	//		$oidveterinario = $veterinario["OIDVETERINARIO"];

			//Busqueda OIDCitas

	//		$consulta = consultarVeterinario2OIDTrabajador($conexion,$oidveterinario);
	//		$oidcita = $consulta["OIDCITA"];

	//		$excepcion = eliminar_veterinario($conexion,$oidtrabajador,$oidveterinario,$oidcita);

			
			
	//	    cerrarConexionBD($conexion);
      //  }else{

			//Busqueda oid_peluquero

		//	$peluquero = consultarPeluquero2OIDTrabajador($conexion,$oidtrabajador);
		//	$oidpelquero = $peluquero["OIDPELUQUERO"];

			//Busqueda OIDCitas

		//	$peluqueria = consultarPeluqueria2OIDPeluquero($conexion,$oidpeluquero);
		//	$oidcita = $peluqueria["OIDCITA"];





		//	$excepcion = eliminar_peluquero($conexion,$oidtrabajador,$oidpelquero,$oidcita);
			
          //  cerrarConexionBD($conexion);
        //}
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_trabajadores.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consulta_trabajadores.php");
	}
	else Header("Location: consulta_trabajadores.php"); // Se ha tratado de acceder directamente a este PHP
?>
