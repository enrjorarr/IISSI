<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_pac($conexion,$usuario) {
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));

	try {
		$consulta = "CALL ALTA_PACIENTE(:IDPaciente,:FechaNac,:ColorPelo,:Raza,:Especie,:Dni)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':IDPaciente',$usuario["idPaciente"]);
		$stmt->bindParam(':Dni',$usuario["nif"]);
		$stmt->bindParam(':ColorPelo',$usuario["colorPelo"]);
		$stmt->bindParam(':FechaNac',$fechaNacimiento);
		$stmt->bindParam(':Raza',$usuario["raza"]);
		$stmt->bindParam(':Especie',$usuario["especie"]);
		
		$stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		
		var_dump($e->getMessage());exit;





		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
		
    }
}

?>