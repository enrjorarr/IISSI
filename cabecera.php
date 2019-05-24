<div class="cabecera">
<header>
	<div class = "foto">
	<img src="images/logo_vet_opt.png" alt="Logo">
	</div>
	<div class="texto">
	<h1>Huellas</h1>
	</div>
	<div class = "menu">

	<ul>
        <li><a href="sobre_nosotros.php"><span title="Sobre nosotros">Sobre Nosotros</span></a></li>
        <li><a href="citas.php"><span title="Citas">Citas</span></a></li>
        <li><a href="contacto.php"><span title="Contacto">Contacto</span></a></li>
		<li><?php if (isset($_SESSION['login'])) {	?>
				<a href="logout.php"><span title="Desconectar">Desconectar</span></a>
			<? }else{ ?>
				<a href="login.php"><span title="Iniciar sesion">Iniciar sesion</span></a>
			<?php } ?>
		</li>
	</ul>
	
	</div>
	<div class="boton">

				<button class="butn" href="login.php">LOGIN</button>

			</div>


	
</header>
</div>



