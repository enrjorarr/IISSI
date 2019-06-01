<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarPacientes.php"); //Completar más tarde
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
        $_SESSION["errores"] = null;
	}
    else {
        

        Header("Location: consulta_pacientes.php");	
    }
    $id = $nuevoUsuario["idPaciente"];

	$conexion = crearConexionBD(); 
	if (eliminarPacientes2ID($conexion,$id)) {
		Header("Location: consulta_pacientes.php");	


	}else{
		Header("Location: excepcion.php");	

	}

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
		<?php if (eliminarPacientes2ID($conexion,$id)) { 
		?>
				<h1>Hola <?php echo $nuevoUsuario["idPaciente"]; ?>, ha sido eliminado</h1>
				<div >	
			   		Pulsa <a href="inicio_sesion.php">aquí</a> para iniciar sesión :].
				</div>
		<?php } else { ?>
				<h1>El usuario ya existe en la base de datos.</h1>
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

