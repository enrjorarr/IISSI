<?php


function consultarPeticiones($conexion) {
	$consulta = "SELECT * FROM PETICIONCITAS "
		. " ORDER BY FECHAINICIO";
		return $conexion->query($consulta);
}

function eliminarPeticion($conexion,$OIDPetCita){
	try{
		$stmt=$conexion->prepare('CALL ELIMINAR_PETCITA(:OIDPetCita)');
		$stmt->bindParam(':OIDPetCita',$OIDPetCita);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();

	}
}

function alta_petCita($conexion,$usuario,$tipoCita) {
    $fechaIni = date('d/m/Y', strtotime($usuario["fecha"]));

   
	

	try {
		$consulta = "CALL ALTA_PETCITA(:Dni, :Motivo,:FechaInicio, :IDPaciente ,:TipoCita)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Dni',$usuario["nif"]);
		$stmt->bindParam(':Motivo',$usuario["motivo"]);
		$stmt->bindParam(':FechaInicio',$fechaIni);
		$stmt->bindParam(':TipoCita',$tipoCita);
		$stmt->bindParam(':IDPaciente',$usuario["idPaciente"]);
   

		$stmt->execute();
		
		return true;	
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
		
    }
}
  
?>