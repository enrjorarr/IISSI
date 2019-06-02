<?php



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
    $fecha = date('d/m/Y', strtotime($usuario["fechaInicio"]));

   
    
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
  
function eliminar_libro($conexion,$Dni) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINAR_PELUQUERIA_POR_CITA(:OidCitas)');
		$stmt->bindParam(':OidCitas',$OidLibro);
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
	}
		function alta_peluqueria($conexion,$OIDPeluquero,$OIDCita) {
			try {
				$consulta = "CALL ALTA_PELUQUERIAS(:OIDPeluquero,:OIDCita)";
				$stmt=$conexion->prepare($consulta);
				$stmt->bindParam(':OIDPeluquero',$OIDPeluquero);
				$stmt->bindParam(':OIDCita',$OIDCita);
				$stmt->execute();		
				return true;
			} catch(PDOException $e) {
				return false;
				// Si queremos visualizar la excepción durante la depuración: $e->getMessage();	
				}
			}
		function alta_consulta($conexion,$OIDPeluquero,$OIDCita) {
			try {
				$consulta = "CALL ALTA_CONSULTA(:OIDVeterinario,:OIDCita)";
				$stmt=$conexion->prepare($consulta);
				$stmt->bindParam(':OIDVeterinario',$OIDPeluquero);
				$stmt->bindParam(':OIDCita',$OIDCita);

				$stmt->execute();		
				return true;
				} catch(PDOException $e) {
				 return false;
				}				
					
			}
?>