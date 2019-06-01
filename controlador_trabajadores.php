<?php	
	session_start();
	
	if (isset($_REQUEST["OIDTRABAJADOR"])){
		$trabajador["OIDTRABAJADOR"] = $_REQUEST["OIDTRABAJADOR"];
		$trabajador["NUMEROTELEFONO"] = $_REQUEST["NUMEROTELEFONO"];
		$trabajador["PASS"] = $_REQUEST["PASS"];
		$trabajador["FECHAINAC"] = $_REQUEST["FECHAINAC"];
		$trabajador["NOMBRE"] = $_REQUEST["NOMBRE"];
		$trabajador["APELLIDOS"] = $_REQUEST["APELLIDOS"];
        $trabajador["DIRECCION"] = $_REQUEST["DIRECCION"];
        $trabajador["EMAIL"] = $_REQUEST["EMAIL"];
        $trabajador["HORASTRABAJO"] = $_REQUEST["HORASTRABAJO"];
        $trabajador["SUELDO"] = $_REQUEST["SUELDO"];
		$trabajador["ESGESTOR"] = $_REQUEST["ESGESTOR"];
		$trabajador["DNI"] = $_REQUEST["DNI"];


		
		$_SESSION["trabajador"] = $trabajador;
			
	 
	 if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_cita.php"); 
	}else {Header("Location: consulta_trabajadores.php");}

?>