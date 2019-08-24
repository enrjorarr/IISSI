<?php
	session_start();
	
	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");
	require_once("gestionarTrabajadores.php");
	$conexion = crearConexionBD(); 
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		
		$emailGestor=$_SESSION["loginGestor"];
	
		$trabajador = consultarTrabajador2email($conexion,$emailGestor);
		
		$oidTrabajador = $trabajador["OIDTRABAJADOR"];
		$gestor = consultarGestor2OIDTrabajador($conexion,$oidTrabajador);

		$oidGestor = $gestor["OIDGESTOR"];


		$nuevoUsuario["OIDGestor"] = $oidGestor;
        $nuevoUsuario["nif"] = $_REQUEST["nif"];
		$nuevoUsuario['fechaInicio'] = $_REQUEST["fechaInicio"];
		$nuevoUsuario['horaInicio'] = $_REQUEST["horaInicio"];
		$nuevoUsuario['duracionMin'] = $_REQUEST["duracionMin"];
		$nuevoUsuario['coste'] = $_REQUEST["coste"];
		$nuevoUsuario["tipoCita"] = $_REQUEST["tipoCita"];
		$nuevoUsuario["OIDTRABAJADOR"] =  $_REQUEST["oidTrabajador"];
		
		

		$_SESSION["formulario"] = $nuevoUsuario;

		
	}
	else // En caso contrario, vamos al formulario
		Header("Location: form_alta_cliente.php");

	// Validamos el formulario en servidor
	
	$errores = validarDatosUsuario($conexion, $nuevoUsuario);
	cerrarConexionBD($conexion);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: erroresValidacion.php');
	} else
		
		Header('Location: accion_alta_cita.php');

///////////////////////////////////////////////////////////
// Validación en servidor del formulario de alta de usuario
///////////////////////////////////////////////////////////
function validarDatosUsuario($conexion, $nuevoUsuario){
	$errores=array();
	// Validación del NIF
	if($nuevoUsuario["nif"]=="") 
		$errores[] = "<p>El NIF no puede estar vacío</p>";
	else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["nif"])){
		$errores[] = "<p>El NIF debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["nif"]. "</p>";
	}

	

	// Validación del gestor			
	if($nuevoUsuario["OIDTRABAJADOR"]=="") 
		$errores[] = "<p>Debe introducirse el OID del trabajador</p>";
	
	// Validación de la fecha inicio
	if($nuevoUsuario["horaInicio"]==""){ 
		$errores[] = "<p>La hora de inicio no puede estar vacío</p>";
	}else if ( !preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/",$nuevoUsuario["horaInicio"]))  {
		$errores[] = "<p>La hora de inicio debe cumplir el siguiente pattern : 23:59 </p>";
	}
	
	// Validación del numero de la feccha de fin
	if($nuevoUsuario["duracionMin"]==""){
		$errores[] = "<p>La duración no puede estar vacía</p>";	
	}else if(!preg_match("/^[0-5][0-9]|[6][0]$/", $nuevoUsuario["duracionMin"])){
		$errores[] = "<p>Las citas no deben durar más de 60 minutos";
	}


	if($nuevoUsuario["fechaInicio"]==""){
		$errores[] = "<p>La fecha no puede estar vacía</p>";	
	}

	if($nuevoUsuario["tipoCita"]==""){
		$errores[] = "<p>El tipo de cita debe estar definico</p>";	
	}

	if($nuevoUsuario["OIDTRABAJADOR"]=="") 
		$errores[] = "<p>El oid no puede estar vacío</p>";
	else if($nuevoUsuario["OIDTRABAJADOR"] > 999){
		$errores[] = "<p>El oid no puede contener mas de 3 cifras: " . $nuevoUsuario["OIDTRABAJADOR"]. "</p>";
	}

	if($nuevoUsuario["coste"]=="") 
		$errores[] = "<p>El coste no puede estar vacío</p>";
	else if(!preg_match("/^[0-9]{2}$/", $nuevoUsuario["coste"])){
		$errores[] = "<p>El coste debe contener 2 cifras: " . $nuevoUsuario["coste"]. "</p>";
	}

	return $errores;
}

?>

