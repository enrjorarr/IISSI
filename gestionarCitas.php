<?php


function esConsulta($conexion,$oidcita) {
	$consulta = "SELECT COUNT(*) AS TOTAL FROM CONSULTAS WHERE OIDCITA=:oidcita";
 $stmt = $conexion->prepare($consulta);
 $stmt->bindParam(':oidcita',$oidcita);
 $stmt->execute();
 $boolean = $stmt->fetchColumn();
	if( $boolean == 0){
	return false;
	}else{
		return true;
	}
 	return $stmt->fetch();
 }


function consultarCitasCliente($conexion) {
	$consulta = "SELECT * FROM CITAS"
		. " WHERE (CITAS.DNI=CLIENTES.DNI)"
		. " ORDER BY FECHAINICIO";
		return $conexion->query($consulta);
}
function consultarCitasPorDNI($conexion,$nif) {
	$consulta = "SELECT * FROM CITAS WHERE DNI=:nif";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':nif',$nif);
	
	$stmt->execute();
	return $stmt->fetch();
	}

function alta_cita($conexion,$usuario) {
    $fecha = date('d/m/Y', strtotime($usuario["fecha"]));

   
    
	try {
		$consulta = "CALL ALTA_CITA( :OIDGestor,:Dni,:FechaInicio, :HoraInicio, :DuracionMin, :Coste)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Dni',$usuario["nif"]);
		$stmt->bindParam(':OIDGestor',$usuario["OIDGestor"]);
		$stmt->bindParam(':FechaInicio',$fecha);
		$stmt->bindParam(':HoraInicio',$usuario["horaInicio"]);
		$stmt->bindParam(':DuracionMin',$usuario["duracionMin"]);
		$stmt->bindParam(':Coste',$usuario["coste"]);
   
		$stmt->execute();
		
		return true;	
	} catch(PDOException $e) {
      
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
		
    }
}
  
function eliminar_peluqueria_por_cita($conexion,$oidcita) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINAR_PELUQUERIA_POR_CITA(:oidcita)');
		$stmt->bindParam(':oidcita',$oidcita);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function eliminar_consulta_por_cita($conexion,$oidcita) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINAR_CONSULTA_POR_CITA(:oidcita)');
		$stmt->bindParam(':oidcita',$oidcita);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
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
function eliminar_consulta2Cita($conexion,$OIDTrabajador) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINAR_CONSULTA_POR_CITA(:OidPeluquero)');
		$stmt->bindParam(':OidPeluquero',$OIDTrabajador);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
function eliminar_peluqueria2Cita($conexion,$OIDTrabajador) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINAR_PELUQUERIA_POR_CITA(:OidPeluquero)');
		$stmt->bindParam(':OidPeluquero',$OIDTrabajador);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
		}
		


		function consultarConsulta2OIDVeterinario($conexion,$oidVeterinario) {
			$consulta = "SELECT * FROM CONSULTAS WHERE OIDVETERINARIO=:oidVeterinario";
			$stmt = $conexion->prepare($consulta);
			$stmt->bindParam(':oidVeterinario',$oidVeterinario);
			
			$stmt->execute();
			return $stmt->fetch();
			}

			function consultarPeluqueria2OIDPeluquero($conexion,$oidPeluquero) {
				$consulta = "SELECT * FROM PELUQUERIAS WHERE OIDPELUQUERO=:oidPeluquero";
				$stmt = $conexion->prepare($consulta);
				$stmt->bindParam(':oidPeluquero',$oidPeluquero);
				
				$stmt->execute();
				return $stmt->fetch();
				}
}
?>