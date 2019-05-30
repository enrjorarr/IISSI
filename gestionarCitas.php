<?php
function alta_cita($conexion,$usuario) {
    $fechaIni = date('d/m/Y', strtotime($usuario["fechaInicio"]));
    $fechaFin = date('d/m/Y', strtotime($usuario["fechaFin"]));
   
    
	try {
		$consulta = "CALL ALTA_CITA(:Dni, :OIDGestor,:FechaInicio, :FechaFin, :DuracionMin, :Coste)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Dni',$usuario["nif"]);
		$stmt->bindParam(':OIDGestor',$usuario["OIDGestor"]);
		$stmt->bindParam(':FechaInicio',$fechaIni);
		$stmt->bindParam(':FechaFin',$fechaFin);
		$stmt->bindParam(':DuracionMin',$usuario["duracionMin"]);
		$stmt->bindParam(':Coste',$usuario["coste"]);
   

		$stmt->execute();
		
		return true;	
	} catch(PDOException $e) {
        var_dump($e->getMessage());
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
		
    }
}
  
function consultarUsuario($conexion,$email,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTES WHERE EMAIL=:email AND PASS=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}
?>