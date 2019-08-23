<?php	
	session_start();	
    
    
	if (isset($_SESSION["petcita"])) {
		$petcita = $_SESSION["petcita"];
		unset($_SESSION["petcita"]);
		
		require_once("gestionBD.php");
        require_once("gestionarPetCitas.php");
        require_once("gestionarTrabajadores.php");
        require_once("gestionarCitas.php");
		
        $conexion = crearConexionBD();

        $email=$_SESSION["loginGestor"];
        $trabajador = consultarTrabajador2email($conexion,$email);
        $oidTrabajador = $trabajador["OIDTRABAJADOR"];
        $trabajador=consultarGestor2OIDTrabajador($conexion,$oidTrabajador);

        $usuario["OIDGestor"]=$trabajador["OIDGESTOR"];
        $usuario["nif"]=$petcita["DNI"];
        $usuario["fechaInicio"]=$petcita["FECHAINICIO"];
        $usuario["horaInicio"]=$petcita["HORAINICIO"];
        $usuario["duracionMin"]=$petcita["DURACIONMIN"];
        $usuario["coste"]=$petcita["COSTE"];
        $usuario["tipoCita"]=$petcita["TIPOCITA"];
        
        var_dump($excepcion1);exit;

        $excepcion1 = alta_cita($conexion,$usuario);
        
        
        
        
        if($excepcion1){
            $excepcion = eliminarPeticion($conexion,$petcita["OIDPETCITA"]);
        }
		cerrarConexionBD($conexion);
		
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_petcitas.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consulta_petcitas.php");
	}
	else Header("Location: consulta_petcitas.php"); // Se ha tratado de acceder directamente a este PHP
?>