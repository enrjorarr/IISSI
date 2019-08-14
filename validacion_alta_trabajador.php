

<?php
	session_start();

	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");

	
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
		$nuevoUsuario["nif"] = $_REQUEST["nif"];
		$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
		$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
		$nuevoUsuario["email"] = $_REQUEST["email"];
		$nuevoUsuario["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$nuevoUsuario["pass"] = $_REQUEST["pass"];
		$nuevoUsuario["confirmpass"] = $_REQUEST["confirmpass"];
		$nuevoUsuario["calle"] = $_REQUEST["calle"];
        $nuevoUsuario["numeroTelefono"] = $_REQUEST["numeroTelefono"];
        $nuevoUsuario["sueldo"] = $_REQUEST["sueldo"];
        $nuevoUsuario["esGestor"] = $_REQUEST["esGestor"];
		$nuevoUsuario["horasTrabajo"] = $_REQUEST["horasTrabajo"];
		$nuevoUsuario["tipoTrabajador"] = $_REQUEST["tipoTrabajador"];

		
	 
		// Guardar la variable local con los datos del formulario en la sesión.
		$_SESSION["formulario"] = $nuevoUsuario;		
	}

	else // En caso contrario, vamos al formulario
		Header("Location: form_alta_trabajador.php");

	// Validamos el formulario en servidor
	$conexion = crearConexionBD(); 
	$errores = validarDatosTrabajador($conexion, $nuevoUsuario);
	$fecha = $nuevoUsuario["fechaNacimiento"];


	cerrarConexionBD($conexion);

	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: erroresValidacion.php');
	} else
		// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
		Header('Location: accion_alta_trabajador.php');

///////////////////////////////////////////////////////////
// Validación en servidor del formulario de alta de usuario
///////////////////////////////////////////////////////////
function validarDatosTrabajador($conexion, $nuevoUsuario){
	$fecha = $nuevoUsuario["fechaNacimiento"];
	$errores=array();
	// Validación del NIF
	if($nuevoUsuario["nif"]=="") 
		$errores[] = "<p>El NIF no puede estar vacío</p>";
	else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["nif"])){
		$errores[] = "<p>El NIF debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["nif"]. "</p>";
	}

	// Validación del Nombre			
	if($nuevoUsuario["nombre"]=="") {
		$errores[] = "<p>El nombre no puede estar vacío</p>";
	}else if(!preg_match("/^[A-Za-z\s]+$/", $nuevoUsuario["nombre"])){
		$errores[] = "<p>El nombre debe tener únicamente letras mayúsculas y minúsculas: " . $nuevoUsuario["nombre"]. "</p>";
	}

	// Validación del Apellidos			
	if($nuevoUsuario["apellidos"]=="") {
		$errores[] = "<p>El apellido no puede estar vacío</p>";
	}else if(!preg_match("/^[A-Za-z\s]+$/", $nuevoUsuario["apellidos"])){
		$errores[] = "<p>El apellido debe tener únicamente letras mayúsculas y minúsculas: " . $nuevoUsuario["apellidos"]. "</p>";
	}

	// Validación del email
	if($nuevoUsuario["email"]==""){ 
		$errores[] = "<p>El email no puede estar vacío</p>";
	}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
		$errores[] = "<p>El email es incorrecto:</p>";
	}	

	// Validación de la contraseña
	if(!isset($nuevoUsuario["pass"]) || strlen($nuevoUsuario["pass"])<8){
		$errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
	}else if(!preg_match("/[a-z]+/", $nuevoUsuario["pass"]) || 
		!preg_match("/[A-Z]+/", $nuevoUsuario["pass"]) || !preg_match("/[0-9]+/", $nuevoUsuario["pass"])){
		$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
	}else if($nuevoUsuario["pass"] != $nuevoUsuario["confirmpass"]){
		$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
	}

	// Validación fecha de nacimiento

	if($nuevoUsuario["fechaNacimiento"]==""){
		$errores[]="<p> La fecha de nacimiento debe estar rellenada </p>";
	}else if(getAge($fecha)<18){

		$errores[]="<p> El trabajador debe ser mayor de edad </p>";
	}
	
	// Validación de la dirección
	if($nuevoUsuario["calle"]==""){

		$errores[] = "<p>La dirección no puede estar vacía</p>";	
	}else if(!preg_match("/^[A-Za-z\s]+$/", $nuevoUsuario["calle"])){
		$errores[] = "<p>La calle debe tener únicamente letras mayúsculas y minúsculas: " . $nuevoUsuario["calle"]. "</p>";
	}

	//Validación número de teléfono
	if($nuevoUsuario["numeroTelefono"]==""){
		$errores[] = "<p>El telefono no puede estar vacío</p>";	
	}else if(!preg_match("/^[0-9]{9}$/", $nuevoUsuario["numeroTelefono"])){
		$errores[] = "<p>El número de teléfono es incorrecto</p>";
	}

	//Validación horas de trabajo semanal
	if($nuevoUsuario["horasTrabajo"]==""){
		$errores[] = "<p>Las horas de trabajo no pueden estar vacías</p>";	
	}else if($nuevoUsuario["horasTrabajo"] > 40 && $nuevoUsuario["horasTrabajo"] > 0){
		$errores[] = "<p>Las horas de trabajo no pueden superar las 40</p>";
	}

	//Validación salario
	if($nuevoUsuario["sueldo"]==""){
		$errores[] = "<p>El sueldo no puede estar vacío</p>";	
	}else if($nuevoUsuario["sueldo"] < 0){
		$errores[] = "<p>El sueldo debe ser mayor que 0</p>";
	}
	
	if($nuevoUsuario["esGestor"]==""){
		$errores[] = "<p>Es necesario especificar si es gestor</p>";	
	}

	if($nuevoUsuario["tipoTrabajador"]==""){
		$errores[] = "<p>El tipo de trabajador no puede estar vacío</p>";	
	}

	return $errores;
}
function getAge($fecha){
	
	$birthdayDate = $fecha;
	$dob = strtotime($birthdayDate);   

	       
	$tdate = time();

	$age = 0;
	while( $tdate > $dob = strtotime('+1 year', $dob))
	{
    	++$age;
	}

	return $age;
}

?>

