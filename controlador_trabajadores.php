<?php	
	session_start();
	
	if (isset($_REQUEST["OIDTRABAJADOR"])){
		$trabajador["OIDTRABAJADOR"] = $_REQUEST["OIDTRABAJADOR"];
		$trabajador["PASS"] = $_REQUEST["PASS"];
		$trabajador["FECHANAC"] = $_REQUEST["FECHANAC"];
		$trabajador["NOMBRE"] = $_REQUEST["NOMBRE"];
		$trabajador["APELLIDOS"] = $_REQUEST["APELLIDOS"];
        $trabajador["DIRECCION"] = $_REQUEST["DIRECCION"];
        $trabajador["EMAIL"] = $_REQUEST["EMAIL"];
        $trabajador["HORASTRABAJO"] = $_REQUEST["HORASTRABAJO"];
        $trabajador["SUELDO"] = $_REQUEST["SUELDO"];
		$trabajador["ESGESTOR"] = $_REQUEST["ESGESTOR"];
		$trabajador["DNI"] = $_REQUEST["DNI"];

		
		
		$_SESSION["trabajador"] = $trabajador;
			
		
	 if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_trabajador.php"); 
	}else {Header("Location: consulta_trabajadores.php");}

?>