<?php
function alta_petCita($conexion,$usuario) {
    $fechaIni = date('d/m/Y', strtotime($usuario["fechaInicio"]));
    $fechaFin = date('d/m/Y', strtotime($usuario["fechaFin"]));
   
	OIDPetCita SMALLINT NOT NULL,
    Dni  CHAR(9) NOT NULL,
    Motivo Varchar(50),
    FechaInicio DATE NOT NULL,
    IDPaciente            CHAR(9)

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