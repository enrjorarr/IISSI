<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>menu</title>
   <link rel="stylesheet" type="text/css" href="css/menu.css">

</head>

<body>
	<ul>
		<li><a href="sobre_nosotros.php">Sobre nosotros</a></li>
	  	<li><a href="citas.php">Citas</a></li>
		<li><a href="contacto.php">Contacto</a></li>


		
 		  	
		<li><?php if (isset($_SESSION['login'])) {	?>
				<a href="logout.php">Desconectar</a>
			<? }else{ ?>
				<a href="login.php">Iniciar Sesi�n</a>
			<?php } ?>
		</li>
		
		<li class="icon">
			<a href="javascript:void(0);" onclick="myToggleMenu()">&#9776;</a>
		</li>	
	</ul>

</body>

</html>
			