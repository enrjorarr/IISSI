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
		$nuevoUsuario["OIDTrabajador"] =  $_REQUEST["oidTrabajador"];
		
		

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
		Header('Location: consulta_petCita.php ');
	} else{
        Header('Location: controlador_petcitas.php');
    }
        
function validarDatosUsuario($conexion, $nuevoUsuario){
        $errores=array();
            // Validación de la fecha inicio
        if($nuevoUsuario["HORAINICIO"]==""){ 
            $errores[] = "<p>La fecha de inicio no puede estar vacío</p>";
        }else if ( !preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/",$nuevoUsuario["HORAINICIO"]))  {
            $errores[] = "<p>La fecha de inicio debe cumplir el siguiente pattern : 23:59 </p>";
        }
    
            // Validación del numero de la feccha de fin
        if($nuevoUsuario["DURACIONMIN"]==""){
            $errores[] = "<p>La fecha de fin no puede estar vacía</p>";
        }else if(!preg_match("/^[0-5][0-9]|[6][0]$/", $nuevoUsuario["DURACIONMIN"])){
            $errores[] = "<p>Las consultas no deben durar más de 60 minutos";
        }
    
        if($nuevoUsuario["COSTE"]==""){
            $errores[]="<p>El coste de la consulta no puede estar vacío </p>";
        }else if(!preg_match("/^[0-9]$/", $nuevoUsuario["COSTE"]))
            $errores[]="<p>El coste de la consulta no puede ser negativo </p>";   
        return $errores;
        }