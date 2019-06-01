<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarPacientes.php"); 
	require_once("gestionarClientes.php"); 



	$conexion = crearConexionBD(); 

		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoPaciente = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_alta_paciente.php");	



?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Veterinaria: Alta de paciente realizada con éxito</title>
  <link rel="stylesheet" type="text/css" href="css/accion_alta_petCita.css" />

  <?php include_once("head.php");?>
</head>

<body>
	<?php
        include_once("cabecera.php");
       
	?>
 
	<main>
		<?php if (alta_pac($conexion, $nuevoPaciente)) { 
		?>
				<h1>Su mascota ha sido registrada correctamente.</h1>
				<div >	
					¿Quieres volver a tu perfil? Pulsa  <a href="consulta_citas.php">aquí</a>.
				</div>
		<?php } else { ?>
				<h1>Su mascota ya se encuentra en la base de datos.</h1>
				<div >	
					¿Quieres volver a tu perfil? Pulsa  <a href="consulta_citas.php">aquí</a>.
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

