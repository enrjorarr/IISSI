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
				<button class="butn" href="login.php">Iniciar sesion</button>
			<? }else{ ?>
				<button class="butn" href="logout.php">Cerrar sesion</button>	
			<?php } ?>

			</div>
	<div class="boton2">

				<a href="perfil_cliente.php"><img src="images/profile_icon.png" alt="Perfil"></a> 

	</div>

	<div class = "menu">

	<ul>
        <li><a href="historiales.php"><span title="Historiales">Historiales</span></a></li>
        <li><a href="citas_trabajadores.php"><span title="Citas">Citas</span></a></li>
	</ul>
	</header>
	</div>