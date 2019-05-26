<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarTrabajadores.php"); //Completar más tarde
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_alta_trabajador.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Clinica Veterinaria: Alta de TRABAJADOR realizada con éxito</title>
</head>

<body>
	<?php
      //  include_once("cabecera.php");
	?>

	<main>
		<?php if (alta_trabajador($conexion, $nuevoUsuario)) { 
				$_SESSION['login'] = $nuevoUsuario['email'];
		?>
				<h1><?php echo $nuevoUsuario["nombre"]; ?> ha sido registrado con exito.</h1>
				<div >	
			   		Pulsa <a href="form_alta_trabajador.php">aquí</a> para registrar un nuevo trabajador.
				</div>
		<?php } else { ?>
				<h1>El usuario <?php echo $nuevoUsuario["nombre"]; ?> ya existe en la base de datos.</h1>
				<div >	
					Pulsa <a href="form_alta_trabajador.php">aquí</a> para volver al formulario.
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

