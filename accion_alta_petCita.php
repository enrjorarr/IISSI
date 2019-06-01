<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarPetCitas.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		$tipo = $nuevoUsuario["tipoCita"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_alta_PetCita.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Veterinaria: Alta de Usuario realizada con éxito</title>
  <?php include_once("head.php")?>
</head>

<body>
	<?php
        include_once("cabecera.php");
	?>

	<main>
		<?php if (alta_petCita($conexion, $nuevoUsuario,$tipo)) { 

		?>
				<h1>Se ha relizado una peticion para citas, en breve se le proporcionara una respuesta, recuerde revisar amenudo su perfil.</h1>
				<div >	
			   		¿Quieres volver a tu perfil? Pulsa  <a href="consulta_citas.php">aquí</a>.
				</div>
		<?php } else { ?>
				<h1>Esa petición ya esta en curso, recuerda mirar a menudo en tu perfil.</h1>
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

