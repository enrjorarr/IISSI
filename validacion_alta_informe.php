<?php
	session_start();

	require_once("gestionBD.php");


	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevoUsuario["fechaConsulta"] = $_REQUEST["fechaConsulta"];
		$nuevoUsuario["motivo"] = $_REQUEST["motivo"];
		$nuevoUsuario["tratamiento"] = $_REQUEST["tratamiento"];
		$nuevoUsuario["OIDHistorial"] = $_REQUEST["OIDHistorial"];
	
		
		// Guardar la variable local con los datos del formulario en la sesión.
		$_SESSION["formulario"] = $nuevoUsuario;		
	}
	else // En caso contrario, vamos al formulario
		Header("Location: form_alta_informe.php");

	// Validamos el formulario en servidor
	$conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $nuevoUsuario);
	cerrarConexionBD($conexion);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: form_alta_informe.php');
	} else
		// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
		Header('Location: accion_alta_informe.php');

///////////////////////////////////////////////////////////
// Validación en servidor del formulario de alta de usuario
///////////////////////////////////////////////////////////
function validarDatosUsuario($conexion, $nuevoUsuario){
	$errores=array();

	// Validación del motivo			
	if($nuevoUsuario["motivo"]=="") 
		$errores[] = "<p>El motivo no puede estar vacío</p>";
	else if(!preg_match("/^[A-Za-z\s]+$/", $nuevoUsuario["motivo"])){
		$errores[] = "<p>El motivo debe tener únicamente letras mayúsculas y minúsculas: " . $nuevoUsuario["motivo"]. "</p>";
	}
    
        // Validación del tratamiento			
	if($nuevoUsuario["tratamiento"]=="") 
		$errores[] = "<p>El tratamiento no puede estar vacío</p>";
	else if(!preg_match("/^[A-Za-z\s]+$/", $nuevoUsuario["tratamiento"])){
		$errores[] = "<p>El motivo debe tener únicamente letras mayúsculas y minúsculas: " . $nuevoUsuario["tratamiento"]. "</p>";
	}

	if($nuevoUsuario["OIDHistorial"]=="") 
		$errores[] = "<p>El OIDHistorial no puede estar vacío</p>";
	else if(!preg_match("/^[0-9]{4}$/", $nuevoUsuario["OIDHistorial"])){
		$errores[] = "<p>El id puede contener un maximo de 4 números: " . $nuevoUsuario["OIDHistorial"]. "</p>";
	}



	return $errores;
}
 
?>

