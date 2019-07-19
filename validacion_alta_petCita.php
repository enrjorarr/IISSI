<?php
	session_start();

	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");
	require_once("gestionarClientes.php"); 

	$email = $_SESSION["login"];

	$conexion = crearConexionBD(); 

    $cliente = consultarUsuario2email($conexion,$email);

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
        // Recogemos los datos del formulario
		$nuevoUsuario["nif"] = $cliente['DNI'];
		$nuevoUsuario['fecha'] = $_REQUEST["fecha"];;
		$nuevoUsuario['motivo'] = $_REQUEST["motivo"];
		$nuevoUsuario['idPaciente'] = $_REQUEST["idPaciente"];
		
		// Guardar la variable local con los datos del formulario en la sesión.
		$_SESSION["formulario"] = $nuevoUsuario;	
		$_SESSION["tipoCita"] = $_SESSION["tipoCita"];
	
	}
	else // En caso contrario, vamos al formulario
		Header("Location: form_alta_petCita.php");

	// Validamos el formulario en servidor
	$conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $nuevoUsuario);
	cerrarConexionBD($conexion);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: form_alta_petCita.php');
	} else
		// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
		Header('Location: accion_alta_petCita.php');

///////////////////////////////////////////////////////////
// Validación en servidor del formulario de alta de usuario
///////////////////////////////////////////////////////////
function validarDatosUsuario($conexion, $nuevoUsuario){
	$errores=array();
	// Validación del NIF
	//if($nuevoUsuario["nif"]=="") 
	//	$errores[] = "<p>El NIF no puede estar vacío</p>";
	//else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["nif"])){
	//	$errores[] = "<p>El NIF debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["nif"]. "</p>";
	//}

	// Validación del gestor			
//	if($nuevoUsuario["OIDGestor"]=="") 
//		$errores[] = "<p>Debe introducirse el OID del gestor</p>";
	
	// Validación de la fecha inicio
	if($nuevoUsuario["fecha"]==""){ 
		$errores[] = "<p>Porfavor indique una fecha.</p>";
	}
	
	// Validación del numero de la feccha de fin
	if($nuevoUsuario["motivo"]==""){
		$errores[] = "<p>Por favor indique una breve descripcion del problema de su animal.</p>";	
	}

	if($nuevoUsuario["idPaciente"]==""){
		$errores[]="<p>El id del paciente debe estar rellenado </p>";
	}else if(!preg_match("/^[0-9]{9}$/", $nuevoUsuario["idPaciente"]))
		$errores[]="<p>El id del paciente debe estar compuesto por 9 números </p>";
	

	return $errores;
}

?>

