<?php	
	session_start();
	
	if (isset($_REQUEST["INFORME"])){
		$informe["FECHACONSULTA"] = $_REQUEST["FECHACONSULTA"];
		$informe["MOTIVO"] = $_REQUEST["MOTIVO"];
		$informe["TRATAMIENTO"] = $_REQUEST["TRATAMIENTO"];
		$informe["OIDINFORME"] = $_REQUEST["OIDINFORME"];

		
		$_SESSION["INFORME"] = $informe;
			
		if (isset($_REQUEST["editar"])) Header("Location: consulta_citas.php"); 
		else /* if (isset($_REQUEST["borrar"])) */ Header("Location: accion_borrar_cita.php"); 
	}
	else 
		Header("Location: consulta_citas.php");

?>