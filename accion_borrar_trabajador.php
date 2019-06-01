<?php	
	session_start();	
	
	if (isset($_SESSION["trabajador"])) {
        $trabajador = $_SESSION["trabajador"];
        
        $oidtrabajador = $trabajador["OIDTRABAJADOR"];

        unset($_SESSION["trabajador"]);
		
		require_once("gestionBD.php");
        require_once("gestionarTrabajadores.php");
        $conexion = crearConexionBD();	

        if(esVeterinario($conexion,$oidtrabajador)){
            $excepcion = eliminar_veterinario($conexion,$trabajador["OIDTRABAJADOR"]);
		    cerrarConexionBD($conexion);
        }else{
            $excepcion = eliminar_peluquero($conexion,$trabajador["OIDTRABAJADOR"]);
            cerrarConexionBD($conexion);
        }
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_trabajadores.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consulta_trabajadores.php");
	}
	else Header("Location: consulta_trabajadores.php"); // Se ha tratado de acceder directamente a este PHP
?>
