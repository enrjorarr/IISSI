<?php


function consultarPeticiones($conexion) {
	$consulta = "SELECT * FROM PETICIONCITAS "
		. " ORDER BY FECHAINICIO";
		return $conexion->query($consulta);
}


function alta_petCita($conexion,$usuario) {
    $fechaIni = date('d/m/Y', strtotime($usuario["fecha"]));

   
	

	try {
		$consulta = "CALL ALTA_PETCITA(:Dni, :Motivo,:FechaInicio, :IDPaciente)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Dni',$usuario["nif"]);
		$stmt->bindParam(':Motivo',$usuario["motivo"]);
		$stmt->bindParam(':FechaInicio',$fechaIni);
		$stmt->bindParam(':IDPaciente',$usuario["idPaciente"]);
   

		$stmt->execute();
		
		return true;	
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
		
    }
}
  
?>