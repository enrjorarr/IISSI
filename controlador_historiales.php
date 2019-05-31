<?php	
	session_start();
	
	if (isset($_REQUEST["OIDHISTORIAL"])){
		$historial["OIDHISTORIAL"] = $_REQUEST["OIDHISTORIAL"];
		$historial["IDPACIENTE"] = $_REQUEST["IDPACIENTE"];
		$historial["OIDINFORME"] = $_REQUEST["OIDINFORME"];
		$historial["FECHACONSULTA"] = $_REQUEST["FECHACONSULTA"];
		$historial["MOTIVOCONSULTA"] = $_REQUEST["MOTIVOCONSULTA"];
        $historial["TRATAMIENTO"] = $_REQUEST["TRATAMIENTO"];

		
		$_SESSION["historial"] = $historial;
			
		if (isset($_REQUEST["editar"])) Header("Location: consulta_historial.php"); 
		/*else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_libro.php");
		else /* if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_libro.php");*/ 
	}
	else 
		Header("Location: consulta_historial.php");

?>
