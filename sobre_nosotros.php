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
	
  <title>Sobre nosotros</title>
  <?php include_once("head.php");?>

</head>

<body>
<?php	

include_once("cabecera.php"); 
?>

<main>


<div class="tituloAbout">
	<h2>¿Quiénes somos?</h2>
</div>

<div class="p">
	<div class = "p1">
		<p>Somos un centro veterinario situado en Villanueva de la Serena que cuenta con más de 12 años de experiencia.</p>
		<p>Nacimos con la idea de poder ofrecer un buen servicio a las mascotas, por eso nuestro equipo ofrece desde asesoramiento
para su mascota hasta su tratamiento.</p>
		<p>Nuestras instalaciones cuentan con un equipamiento moderno y con todo el material necesario para garantizar los mejores 
resultados para su mascota.</p>
		<p>Nuestra filosofía es simple, fomentar la prevencion y hacer medicina de calidad basada en la comunicación y el trato
cercano con el cliente.</p>
		<p>Venga a conocer nuestro centro, estaremos encantados de poder atender a sus mascotas sea cual sea su especie o raza.</p>
	</div>
	<div class = "p2">
		<img class = "fotoAbout" src="images/foto_about.jpg">
	</div>
</div>

</main>

<?php	
	include_once("pie.php");
?>		
</body>
</html>
