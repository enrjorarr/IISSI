<?php
function consulta_paginada( $conn, $query, $pag_num, $pag_size )
{
	try {
		$conexion = crearConexionBD();
		$primera = ( $pag_num - 1 ) * $pag_size + 1;
		$ultima  = $pag_num * $pag_size;
		$consulta_paginada = 
			 "SELECT * FROM ( "
				."SELECT ROWNUM RNUM, AUX.* FROM ( $query ) AUX "
				."WHERE ROWNUM <= :ultima"
			.") "
			."WHERE RNUM >= :primera";

		$stmt = $conn->prepare( $consulta_paginada );
		$stmt->bindParam( ':primera', $primera );
		if(isset($_POST["id"])){
			$stmt->bindParam(":paciente",$_POST["id"]);
		}
		if(!(strpos($query,":dniConsultaCita")===FALSE) and (isset($_SESSION['login']))){
			
				$email = $_SESSION['login'];
	
				$usuario = consultarUsuario2email($conexion,$email);
	
				$dni = $usuario["DNI"];
	
			$stmt->bindParam(":dniConsultaCita",$dni);
		}
		if(!(strpos($query,":oidveterinario")===FALSE) and (isset($_SESSION['loginTrabajador']))){
			
			$email = $_SESSION['loginTrabajador'];

			$usuario = consultarTrabajador2email($conexion,$email);

			$oidtrabajador = $usuario["OIDTRABAJADOR"];

			$veterinario=consultarVeterinario2OIDTrabajador($conexion,$oidtrabajador);

			$oidveterinario = $veterinario["OIDVETERINARIO"];

		$stmt->bindParam(":oidveterinario",$oidveterinario);
		}
		if(!(strpos($query,":oidpeluquero")===FALSE) and (isset($_SESSION['loginTrabajador']))){
			
			$email = $_SESSION['loginTrabajador'];

			$usuario = consultarTrabajador2email($conexion,$email);

			$oidtrabajador = $usuario["OIDTRABAJADOR"];

			$veterinario=consultarPeluquero2OIDTrabajador($conexion,$oidtrabajador);

			$oidveterinario = $veterinario["OIDPELUQUERO"];

		$stmt->bindParam(":oidpeluquero",$oidveterinario);
		}
		$stmt->bindParam( ':ultima',  $ultima  );
		//var_dump($_POST["id"]);exit;
		$stmt->execute();
		
		return $stmt;
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 

function total_consulta( $conn, $query )
{
	try {
		$conexion = crearConexionBD();
		$total_consulta = "SELECT COUNT(*) AS TOTAL FROM ($query)";

		$stmt = $conn->prepare($total_consulta);
		if(isset($_POST["id"])){
			$stmt->bindParam(":paciente",$_POST["id"]);
		}
		if(!(strpos($query,":dniConsultaCita")===FALSE) and (isset($_SESSION['login']))){
			
			$email = $_SESSION['login'];

			$usuario = consultarUsuario2email($conexion,$email);

			$dni = $usuario["DNI"];

		$stmt->bindParam(":dniConsultaCita",$dni);
		}
		if(!(strpos($query,":oidveterinario")===FALSE) and (isset($_SESSION['loginTrabajador']))){
			
			$email = $_SESSION['loginTrabajador'];

			$usuario = consultarTrabajador2email($conexion,$email);

			$oidtrabajador = $usuario["OIDTRABAJADOR"];

			$veterinario=consultarVeterinario2OIDTrabajador($conexion,$oidtrabajador);

			$oidveterinario = $veterinario["OIDVETERINARIO"];

		$stmt->bindParam(":oidveterinario",$oidveterinario);
		}
		if(!(strpos($query,":oidpeluquero")===FALSE) and (isset($_SESSION['loginTrabajador']))){
			
			$email = $_SESSION['loginTrabajador'];

			$usuario = consultarTrabajador2email($conexion,$email);

			$oidtrabajador = $usuario["OIDTRABAJADOR"];

			$veterinario=consultarPeluquero2OIDTrabajador($conexion,$oidtrabajador);

			$oidveterinario = $veterinario["OIDPELUQUERO"];

		$stmt->bindParam(":oidpeluquero",$oidveterinario);
		}
		$stmt->execute();
		$result = $stmt->fetch();
		$total = $result['TOTAL'];
		return  $total;
	}
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 
?>
