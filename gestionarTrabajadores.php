<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de trabajadores de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_trabajador($conexion,$trabajador) {
	$fechaNacimiento = date('d/m/Y', strtotime($trabajador["fechaNacimiento"]));

	try { 
		$consulta = "CALL ALTA_TRABAJADOR(:Dni,:FechaNac,:Sueldo,:Pass, :Direccion, :NumeroTelefono, :Email , :Nombre, :Apellidos,:EsGestor,:HorasTrabajo)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Dni',$trabajador["nif"]);
		$stmt->bindParam(':Nombre',$trabajador["nombre"]);
		$stmt->bindParam(':Apellidos',$trabajador["apellidos"]);
		$stmt->bindParam(':Direccion',$trabajador["calle"]);
		$stmt->bindParam(':FechaNac',$fechaNacimiento);
		$stmt->bindParam(':Email',$trabajador["email"]);
		$stmt->bindParam(':Pass',$trabajador["pass"]);
		$stmt->bindParam(':Sueldo',$trabajador["sueldo"]);
		$stmt->bindParam(':NumeroTelefono',$trabajador["numeroTelefono"]);
		$stmt->bindParam(':EsGestor',$trabajador["esGestor"]);
		$stmt->bindParam(':HorasTrabajo',$trabajador["horasTrabajo"]);


		$stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		var_dump($e->getMessage());exit();
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
		
    }
} function alta_peluquero($conexion,$trabajador) {
	try {
		$consulta = "CALL ALTA_PELUQUERO(:OIDTrabajador)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':OIDTrabajador',$trabajador["OIDTRABAJADOR"]);
		$stmt->execute();		
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();	
    }
} function alta_veterinario($conexion,$trabajador) {
	try {
		$consulta = "CALL ALTA_VETERINARIO(:OIDTrabajador)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':OIDTrabajador',$trabajador["OIDTRABAJADOR"]);
		$stmt->execute();		
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();	
    }
} function alta_gestor($conexion,$trabajador) {
	try {
		$consulta = "CALL ALTA_GESTOR(:OIDTrabajador)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':OIDTrabajador',$trabajador["OIDTRABAJADOR"]);
		$stmt->execute();		
		return true;
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();	
    }
}
  
function consultarTrabajador($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM TRABAJADORES WHERE EMAIL=:email AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function existeTrabajador($conexion,$email,$pass) {
	$consulta = "SELECT COUNT(*) AS TOTAL FROM TRABAJADORES WHERE EMAIL=:email AND PASS=:pass";
 $stmt = $conexion->prepare($consulta);
 $stmt->bindParam(':email',$email);
 $stmt->bindParam(':pass',$pass);
 $stmt->execute();
 $boolean = $stmt->fetchColumn();
	if( $boolean == 0){
	return false;
	}else{
		return true;
	}
}
function consultarTrabajador2email($conexion,$email) {
	$consulta = "SELECT * FROM TRABAJADORES WHERE EMAIL=:email";
 $stmt = $conexion->prepare($consulta);
 $stmt->bindParam(':email',$email);
 
 $stmt->execute();
 return $stmt->fetch();
 }
 function consultarGestor2OIDTrabajador($conexion,$oidTrabajador) {
	$consulta = "SELECT * FROM GESTORES WHERE OIDTRABAJADOR=:oidtrabajador";
 $stmt = $conexion->prepare($consulta);
 $stmt->bindParam(':oidtrabajador',$oidTrabajador);
 
 $stmt->execute();
 return $stmt->fetch();
 }
 function consultarVeterinario2OIDTrabajador($conexion,$oidTrabajador) {
	$consulta = "SELECT * FROM Veterinarios WHERE OIDTRABAJADOR=:oidtrabajador";
 $stmt = $conexion->prepare($consulta);
 $stmt->bindParam(':oidtrabajador',$oidTrabajador);
 
 $stmt->execute();
 return $stmt->fetch();
 }
 function consultarPeluquero2OIDTrabajador($conexion,$oidTrabajador) {
	$consulta = "SELECT * FROM PELUQUEROS WHERE OIDTRABAJADOR=:oidtrabajador";
 $stmt = $conexion->prepare($consulta);
 $stmt->bindParam(':oidtrabajador',$oidTrabajador);
 
 $stmt->execute();
 return $stmt->fetch();
 }

 function esVeterinario($conexion,$oidtrabajador) {
	$consulta = "SELECT COUNT(*) AS TOTAL FROM VETERINARIOS WHERE OIDTRABAJADOR=:oidtrabajador";
 $stmt = $conexion->prepare($consulta);
 $stmt->bindParam(':oidtrabajador',$oidtrabajador);
 $stmt->execute();
 $boolean = $stmt->fetchColumn();
	if( $boolean == 0){
	return false;
	}else{
		return true;
	}
 	return $stmt->fetch();
 }


 function eliminar_veterinario($conexion,$OIDTrabajador) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINAR_VETERINARIO(:OidTrabajador)');
		$stmt->bindParam(':OidTrabajador',$OIDTrabajador);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
function eliminar_peluquero($conexion,$OIDTrabajador) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINAR_PELUQUERO(:OidTrabajador)');
		$stmt->bindParam(':OidTrabajador',$OIDTrabajador);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
?>