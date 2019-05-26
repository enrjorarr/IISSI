<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
  <link rel="stylesheet" type="text/css" href="css/about.css" />
  <link href="https://fonts.googleapis.com/css?family=ABeeZee&display=swap" rel="stylesheet">
	<script type="text/javascript" src="./js/boton.js"></script>
  <title>Reserva cita</title>
  <?php include_once("head.php")?>

</head>

<body>
<?php	

	include_once("cabecera.php"); 
?>
<main>


<div class="p">
	<div class = "p1">

		<div>
			<label for="motivo">Nombre:<em>*</em></label>
			<input id="nombre" name="nombre" type="text" value="<?php echo $formulario['nombre'];?>" required/>
		</div>

			<div>
				<label for="apellidos">Apellidos:</label>
				<input id="apellidos" name="apellidos" type="text" size="80" value="<?php echo $formulario['apellidos'];?>"/>
			</div>

			<div>
				<label for="fechaNacimiento">Fecha de nacimiento:<em>*</em></label>
				<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $formulario['fechaNacimiento'];?>"/>
			</div>
	    <input type="submit" name="submit" value="submit" />
	</div>
	<div class = "p2">
	</div>
</div>

</main>

<?php	
	include_once("pie.php");
?>		
</body>
</html>
