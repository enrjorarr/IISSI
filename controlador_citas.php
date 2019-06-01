<?php	
	session_start();
	
	if (isset($_REQUEST["OIDCITA"])){
		$cita["OIDCITA"] = $_REQUEST["OIDCITA"];
		$cita["DNI"] = $_REQUEST["DNI"];
		$cita["OIDGESTOR"] = $_REQUEST["OIDGESTOR"];
		$cita["FECHAINICIO"] = $_REQUEST["FECHAINICIO"];
		$cita["HORAINICIO"] = $_REQUEST["HORAINICIO"];
		$cita["DURACIONMIN"] = $_REQUEST["DURACION"];
		$cita["COSTE"] = $_REQUEST["COSTE"];
		
		$_SESSION["cita"] = $cita;
			
	 
	 if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_cita.php"); 
	}else {Header("Location: consulta_citas.php");}

?>