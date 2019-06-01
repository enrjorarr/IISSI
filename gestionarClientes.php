<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_clientes($conexion,$usuario) {
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));

	try {
		$consulta = "CALL ALTA_CLIENTE(:Dni,:FechaNac,:NumeroTelefono,:Pass, :Direccion,  :Email , :Nombre, :Apellidos)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Dni',$usuario["nif"]);
		$stmt->bindParam(':Nombre',$usuario["nombre"]);
		$stmt->bindParam(':Apellidos',$usuario["apellidos"]);
		$stmt->bindParam(':Direccion',$usuario["calle"]);
		$stmt->bindParam(':FechaNac',$fechaNacimiento);
		$stmt->bindParam(':Email',$usuario["email"]);
		$stmt->bindParam(':Pass',$usuario["pass"]);
    $stmt->bindParam(':NumeroTelefono',$usuario["numeroTelefono"]);

		$stmt->execute();
		
		return true;	
	} catch(PDOException $e) {
		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
		
    }
}


function consultarUsuario2email($conexion,$email) {
	$consulta = "SELECT * FROM CLIENTES WHERE EMAIL=:email";
 $stmt = $conexion->prepare($consulta);
 $stmt->bindParam(':email',$email);
 $stmt->execute();
 return $stmt->fetch();
}

function existeCliente($conexion,$email,$pass) {
	$consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTES WHERE EMAIL=:email AND PASS=:pass";
 $stmt = $conexion->prepare($consulta);
 $stmt->bindParam(':email',$email);
 $stmt->bindParam(':pass',$pass);
 $stmt->execute();
 $boolean = $stmt->fetchColumn();
	if( $boolean == 0){
	return false;
	}else{
		return true;
	}
}
function modificar_cliente($conexion,$EMAIL,$NUMEROTELEFONO,$NOMBRE,$APELLIDOS,$DIRECCION,$PASS) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_CLIENTE(:Email,:NumeroTelefono,:Nombre,:Apellidos,:Direccion,:Pass)');
		$stmt->bindParam(':Email',$EMAIL);
		$stmt->bindParam(':NumeroTelefono',$NUMEROTELEFONO);
		$stmt->bindParam(':Nombre',$NOMBRE);
		$stmt->bindParam(':Apellidos',$APELLIDOS);
		$stmt->bindParam(':Direccion',$DIRECCION);
		$stmt->bindParam(':Pass',$PASS);
		var_dump($EMAIL);		var_dump($NOMBRE);
		var_dump($NUMEROTELEFONO);
		var_dump($APELLIDOS);
		var_dump($PASS);

		$stmt->execute();


		return true;
	} catch(PDOException $e) {//$e->getMessage()
		return $e->getMessage();
    }
}
?>
