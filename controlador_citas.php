<?php	
	session_start();
	
	if (isset($_REQUEST["OIDCITA"])){
		$libro["OIDCITA"] = $_REQUEST["OIDCITA"];
		$libro["DNI"] = $_REQUEST["DNI"];
		$libro["OIDGESTOR"] = $_REQUEST["OIDGESTOR"];
		$libro["FECHA"] = $_REQUEST["FECHA"];
		$libro["DURACIONMIN"] = $_REQUEST["DURACION"];
		$libro["COSTE"] = $_REQUEST["COSTE"];
		
		$_SESSION["cita"] = $cita;
			
		if (isset($_REQUEST["editar"])) Header("Location: consulta_citas.php"); 
		else /* if (isset($_REQUEST["borrar"])) */ Header("Location: accion_borrar_cita.php"); 
	}
	else 
		Header("Location: consulta_citas.php");

?>