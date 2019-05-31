<?php	
	session_start();
	
	if (isset($_REQUEST["IDPACIENTE"])){
		$paciente["IDPACIENTE"] = $_REQUEST["IDPACIENTE"];
		$paciente["FECHANAC"] = $_REQUEST["FECHANAC"];
		$paciente["COLORPELO"] = $_REQUEST["COLORPELO"];
		$paciente["RAZA"] = $_REQUEST["RAZA"];
        $paciente["ESPECIE"] = $_REQUEST["ESPECIE"];
        $paciente["DNI"] = $_REQUEST["DNI"];
        
		
		$_SESSION["paciente"] = $paciente;
			
		if (isset($_REQUEST["editar"])) Header("Location: consulta_pacientes.php"); 
		/*else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_libro.php");
		else /* if (isset($_REQUEST["borrar"])) *//* Header("Location: accion_borrar_libro.php"); */
	}
	else 
		Header("Location: consulta_pacientes.php");

?>
