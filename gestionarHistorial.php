<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_informes($conexion,$usuario) {


	try {
		$consulta = "CALL ALTA_HISTORIAL(:IDPaciente)";
        $stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':IDPaciente',$usuario["IDPaciente"]);

		$stmt->execute();
		
		return true;	
	} catch(PDOException $e) {
        var_dump($e->getMessage());

		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
		
    }
}

?>