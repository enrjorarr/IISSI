<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarCitas.php");
	require_once("gestionarTrabajadores.php");
		
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$gestor = $_SESSION["formulario"];
		
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_alta_cita.php");	

	$conexion = crearConexionBD(); 
	




?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/accion_alta_petCita.css" />

  <title>Gestión de Veterinaria: Alta de Usuario realizada con éxito</title>
  <?php include_once("head.php")?>
</head>

<body>
	<?php
        include_once("cabecera.php");
	?>

	<main>
		<?php if (alta_cita($conexion, $gestor)) { 

		?>
				<h1>La cita se ha registrado satisfactoriamente</h1>
				<div >	
				</div>
		<?php } else { ?>
				<h1>Puede que el dni del cliente no exista.</h1>
				<div >	
					Pulsa <a href="form_alta_cliente.php">aquí</a> para volver al formulario.
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

