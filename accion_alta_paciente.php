<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarPacientes.php"); 
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoPaciente = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_alta_paciente.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Veterinaria: Alta de paciente realizada con éxito</title>
  <link rel="stylesheet" type="text/css" href="css/accion_alta_trabajador.css" />

  <?php include_once("head_staff.php");?>
</head>

<body>
	<?php
        include_once("cabecera_gestor.php");
       
	?>

	<main>
		<?php if (alta_pac($conexion, $nuevoPaciente)) { 
		?>
				<h1>Se ha registrado el paciente : <?php echo $nuevoPaciente["idPaciente"]; ?></h1>
				<div >	
			   		Pulsa <a href="inicio_sesion.php">aquí</a> para iniciar sesión :].
				</div>
		<?php } else { ?>
				<h1>El usuario ya existe en la base de datos.</h1>
				<div >	
					Pulsa <a href="form_alta_paciente.php">aquí</a> para volver al formulario.
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

