<?php	
	session_start();
	
	if (isset( $_REQUEST["OIDPETCITA"])){
		
		$petcita["DNI"] =$_REQUEST["DNI"];
		$petcita["MOTIVO"] = $_REQUEST["MOTIVO"];
		$petcita["FECHAINICIO"] = $_REQUEST["FECHAINICIO"];
		$petcita["IDPACIENTE"] = $_REQUEST["IDPACIENTE"];
		$petcita["OIDPETCITA"] =$_REQUEST["OIDPETCITA"];
		
		$_SESSION["petcita"] = $petcita;
			
	 
	 if (isset( $_REQUEST["borrar"]))  {	
		Header("Location: accion_borrar_petcita.php");
	}
	
	 if (isset( $_REQUEST["aceptar"])) {
		
		$petcita["HORAINICIO"] = $_REQUEST["HoraInicio"];
		$petcita["DURACIONMIN"] = $_REQUEST["DuracionMin"];
		$petcita["COSTE"] = $_REQUEST["Coste"];
		$_SESSION["petcita"] = $petcita;
		
		Header("Location: accion_aceptar_petcita.php");
	 }
	}else {Header("Location: consulta_petcitas.php");}

?>