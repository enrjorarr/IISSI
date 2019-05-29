<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_informes($conexion,$usuario) {

        $fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaConsulta"]));

	try {
		$consulta = "CALL ALTA_INFORME(:FechaConsulta,:Motivo,:Tratamiento,:OIDHistorial)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':FechaConsulta',$fechaNacimiento);
		$stmt->bindParam(':Motivo',$usuario["motivo"]);
		$stmt->bindParam(':Tratamiento',$usuario["tratamiento"]);
		$stmt->bindParam(':OIDHistorial',$usuario["OIDHistorial"]);

		$stmt->execute();
		
		return true;	
	} catch(PDOException $e) {
        var_dump($e->getMessage());

		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
		
    }
}

?>