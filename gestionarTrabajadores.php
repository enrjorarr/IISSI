<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de trabajadores de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_trabajador($conexion,$usuario) {
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));

	try {
		$consulta = "CALL ALTA_TRABAJADOR(:Dni,:FechaNac,:Sueldo,:Pass, :Direccion,  :Email , :Nombre, :Apellidos,:EsGestor,:HorasTrabajo)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Dni',$usuario["nif"]);
		$stmt->bindParam(':Nombre',$usuario["nombre"]);
		$stmt->bindParam(':Apellidos',$usuario["apellidos"]);
		$stmt->bindParam(':Direccion',$usuario["calle"]);
		$stmt->bindParam(':FechaNac',$fechaNacimiento);
		$stmt->bindParam(':Email',$usuario["email"]);
		$stmt->bindParam(':Pass',$usuario["pass"]);
		$stmt->bindParam(':NumeroTelefono',$usuario["numeroTelefono"]);
		$stmt->bindParam(':EsGestor',$usuario["esGestor"]);
		$stmt->bindParam(':HorasTrabajo',$usuario["horasTrabajo"]);


		$stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
		
    }
}
  
function consultarUsuario($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM TRABAJADORES WHERE EMAIL=:email AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}

?>