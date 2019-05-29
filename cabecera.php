<?php 
session_start();
?>
<div class="cabecera" style="background-image: url('images/fondo4.jpg')">
<header>
	<div class = "foto">
	<img src="images/logo_transparente.png" alt="Logo">
	</div>
	<div class="texto">
	<h1>H U E L L A S</h1>
	</div>
	<div class="boton1">
			<?php if (isset($_SESSION['login'])) {	?>
				<h1>Hola pato</h1>
				<button class="butn" href="inicio_sesion.php">Iniciar sesion</button>
			<? }else{ ?>
				<h1>Hola pata</h1>
				<button class="butn" href="cierre_sesion.php">Cerrar sesion</button>	
			<?php } ?>
	</div>
	<div class="boton2">

				<a href="perfil_cliente.php"><img src="images/profile_icon.png" alt="Perfil"></a> 

	</div>

	<div class = "menu">

	<ul>
        <li><a href="sobre_nosotros.php"><span title="Sobre nosotros">Sobre Nosotros</span></a></li>
        <li><a href="citas.php"><span title="Citas">Citas</span></a></li>
        <li><a href="contacto.php"><span title="Contacto">Contacto</span></a></li>
	</ul>
	
	</div>
	

	
</header>
</div>



