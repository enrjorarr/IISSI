<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
<style>
	.container {
  height: 35px;
  
 
	}

	.vertical-center {
  margin: 0;
  position: absolute;
  top: 50%;
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
	right: -90px;
	}
	
</style>
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
    <link rel="stylesheet" type="text/css" href="css/biblio.css" />
	<script type="text/javascript" src="./js/boton.js"></script>
  <title>Gestión de biblioteca: Sobre Nosotros</title>
</head>

<body>
<?php	
	include_once("include/cabecera.php"); 
	include_once("include/menu.php");
?>
<main>

<h3>Introducción a la Ingeniería del Software y los Sistemas de Información</h2>

<h4>Objetivos y competencias<sup><a href="#fn1" id="r1">[1]</a></sup></h3>

<ul>
<div class = "container">
	<div><img style="width:30px; height:30px;" src="images/ContactoImagen.png"></div>
	<div class="vertical-center"><a> Telefono de contacto </a></div>		
	<ul>
		<li>92321321</li>
		<li>92321321</li><br>
	</ul>
</div>


</ul>



</main>

<?php	
	include_once("include/pie.php");
?>		
</body>
</html>