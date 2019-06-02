<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarHistorial.php"); //Completar más tarde
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_alta_historial.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Alta informe</title>
  <link rel="stylesheet" type="text/css" href="css/accion_alta_petCita.css" />

  <?php include_once("head_staff.php")?>
</head>

<body>
	<?php
        include_once("cabecera_trabajadores.php");
   
	?>

	<main>
		<?php if (alta_informes($conexion, $nuevoUsuario)) { 
				$_SESSION['login'] = $nuevoUsuario['IDPaciente'];
		?>
				<h1>El informe se ha creado correctamente.</h1>
				<div >	
			   		Pulsa <a href="historial_paciente.php">aquí</a> para volver.
				</div>
		<?php } else { ?>
				<h1>Parece que el paciente ya tiene un historial o no existe un paciente con ese id.</h1>
				<div >	
					Pulsa <a href="form_alta_historial.php">aquí</a> para volver al formulario.
				</div>
		<?php } ?>

	</main>

	<?php
		include_once("pie.php");
	?>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>

