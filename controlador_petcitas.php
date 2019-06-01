<?php	
	session_start();
	
	if (isset($_REQUEST["OIDPETCITA"])){
		$cita["DNI"] = $_REQUEST["DNI"];
		$cita["MOTIVO"] = $_REQUEST["MOTIVO"];
		$cita["FECHAINICIO"] = $_REQUEST["FECHAINICIO"];
		$cita["IDPACIENTE"] = $_REQUEST["IDPACIENTE"];
		
		$_SESSION["petcita"] = $petcita;
			
	 
	 if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_petcita.php"); 
	}else {Header("Location: consulta_petcitas.php");}

?>