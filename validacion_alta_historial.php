<?php
	session_start();

	require_once("gestionBD.php");


	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevoUsuario["IDPaciente"] = $_REQUEST["IDPaciente"];
		
	
		
		// Guardar la variable local con los datos del formulario en la sesión.
		$_SESSION["formulario"] = $nuevoUsuario;		
	}
	else // En caso contrario, vamos al formulario
		Header("Location: form_alta_historial.php");

	// Validamos el formulario en servidor
	$conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $nuevoUsuario);
	cerrarConexionBD($conexion);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: erroresValidacion.php');
	} else
		// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
		Header('Location: accion_alta_historial.php');

///////////////////////////////////////////////////////////
// Validación en servidor del formulario de alta de usuario
///////////////////////////////////////////////////////////
function validarDatosUsuario($conexion, $nuevoUsuario){
	$errores=array();

	// Validación del motivo			
	if($nuevoUsuario["IDPaciente"]=="") 
		$errores[] = "<p>El id no puede estar vacío</p>";
	else if(!preg_match("/^[0-9]{9}$/", $nuevoUsuario["IDPaciente"])){
		$errores[] = "<p>El id debe contener 9 números: " . $nuevoUsuario["IDPaciente"]. "</p>";
	}
	return $errores;

    }
	


?>

