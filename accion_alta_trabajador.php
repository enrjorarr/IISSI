<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarTrabajadores.php"); 
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoTrabajador = $_SESSION["formulario"];
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
  <link rel="stylesheet" type="text/css" href="css/accion_alta_trabajador.css" />

  <?php include_once("head_staff.php"); ?>
</head>

<body>
	<?php
        include_once("cabecera_trabajadores.php");
	?>

	<main>
		<?php 
		
			if (alta_trabajador($conexion, $nuevoTrabajador)) { 
				$_SESSION['login'] = $nuevoTrabajador['email'];
				$email = $nuevoTrabajador['email'];
				$trabajador = consultarTrabajador2email($conexion,$email);

				if($nuevoTrabajador["esGestor"] == "s"){
					$boolean = alta_gestor($conexion, $trabajador);
						if($nuevoTrabajador["tipoTrabajador"] == "veterinario"){
							alta_veterinario($conexion, $trabajador);

						}else{
							alta_peluquero($conexion, $trabajador);

						}
				}else{
					if($nuevoTrabajador["tipoTrabajador"] == "veterinario"){
						alta_veterinario($conexion, $trabajador);

					}else{
						alta_peluquero($conexion, $trabajador);

					}
				}

		?>
		
				<h1>El trabajador ha sido registrado con exito como <?php echo $nuevoTrabajador["tipoTrabajador"] ?>.</h1>
				<div >	
			   		Pulsa <a href="form_alta_trabajador.php">aquí</a> para registrar un nuevo trabajador.
				</div>
		<?php } else { ?>
				<h1>El trabajador <?php echo $nuevoTrabajador["nombre"]; ?> ya existe en la base de datos.</h1>
				<div >	
				Pulsa <a href="form_alta_trabajador.php">aquí</a> para registrar un nuevo trabajador.
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

