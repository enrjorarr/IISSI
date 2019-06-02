<?php	
	session_start();
	
	if (isset($_REQUEST["INFORME"])){
		$informe["OIDINFORME"] = $_REQUEST["OIDINFORME"];
		$informe["FECHACONSULTA"] = $_REQUEST["FECHACONSULTA"];
		$informe["MOTIVOCONSULTA"] = $_REQUEST["MOTIVOCONSULTA"];
		$informe["TRATAMIENTO"] = $_REQUEST["TRATAMIENTO"];
		$informe["OIDHISTORIAL"] = $_REQUEST["OIDHISTORIAL"];

		$_SESSION["INFORME"] = $informe;
			
	/*	if (isset($_REQUEST["editar"])) Header("Location: consulta_citas.php"); 
		else /* if (isset($_REQUEST["borrar"])) *//* Header("Location: accion_borrar_cita.php"); 
	}
	else */
		Header("Location: historial_paciente.php");

?>