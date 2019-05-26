<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
  <link rel="stylesheet" type="text/css" href="css/contacto.css" />
	<script type="text/javascript" src="./js/boton.js"></script>
	<title>contacto</title>
	<?php
		include_once("head.php");
	?>
</head>

<body>
<?php	
	include_once("cabecera.php"); 
?>
<main>

<div class="p">
	<div class = "p1">
		<div class = "p11">
			<div class ="lugar">
				<h2>Contacta con nosotros</h2>
			</div>
			<div class = "reloj">
				<p><img src=images/reloj-de-pared.png width="16" height="16">.  HORARIO</p>
			</div>
			<div class = "texto5">
				<p>De lunes a jueves</p>
				<p>de 8:00h a 19:00h.</p>
				<p>Viernes</p>
				<p>de 8:00h a 19:00h.</p>
			</div>
			<div class = "p1.1.2">
				<div class = "reloj">
					<p><img src=images/correo.png width="16" height="16">.  E-MAIL</p>
				</div>
			</div>
			<div class = "p1.1.2">
				<div class = "texto5">
					<p>poner aqui un email</p>
				</div>
			</div>
			<div class = "p1.1.2">
				<div class = "reloj">
					<p><img src=images/telefono.png width="16" height="16">.  TELÉFONO</p>
				</div>
			</div>
			<div class = "p1.1.2">
				<div class = "texto5">
					<p>Tel: 976311294320 - 234098235872</p>
				</div>
			</div>
			<div class = "p1.1.2">
				<div class = "reloj">
					<p><img src=images/ubicacion.png width="16" height="16">.  DIRECCIÓN</p>
				</div>
			</div>
			<div class = "p1.1.2">
				<div class = "texto5">
					<p>Urbanización parque de Roma,</p>
					<p>bloque 45</p>
					<p>41013 - Sevilla</p>
				</div>
			</div>
		</div>
		</div>
	<div class = "p2">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1844.269772337436!2d-5.798117441185871!3d38.97698158831014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1459999beb0727%3A0x8954b11b82f5a1b4!2sHuellas+Clinica+Veterinaria!5e0!3m2!1ses!2ses!4v1558458729690!5m2!1ses!2ses" width="600" height="550" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<?php	
	include_once("pie.php");
?>		
</div>
</main>


</body>
</html>