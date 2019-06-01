<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */



	function consultarTodosPacientes($conexion) {
			$consulta = "SELECT * FROM PACIENTES"
				. " WHERE (CLIENTES.DNI=PACIENTES.DNI)"
				. " ORDER BY IDPACIENTE";
				return $conexion->query($consulta);
	}
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
		function eliminarPacientes2ID($conexion,$id) {
			try {
				$consulta = "CALL ELIMINAR_PACIENTE_POR_ID(:IDPaciente)";
				$stmt = $conexion->prepare($consulta);
				$stmt->bindParam(':IDPaciente',$id);
			
				$stmt->execute();
				
				return true;
			} catch (PDOException $e) {
				return false;
			}
			
		 }
		 
		
		function consultarPacientes2ID($conexion,$id) {
			$consulta = "SELECT * FROM Pacientes WHERE IDPaciente=:id";
			$stmt = $conexion->prepare($consulta);
			$stmt->bindParam(':id',$id);
			
			$stmt->execute();
			return $stmt->fetch();
			
		 }
		 
	 

?>