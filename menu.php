<nav>
	<ul class="topnav" id="myTopnav">
		<li><a href="sobre_nosotros.php">Sobre nosotros</a></li>
	  	<li><a href="citas.php">Citas</a></li>
		<li><a href="faq.php">FAQ</a></li>
		<li><a href="contacto.php">Contacto</a></li>


		
 		  	
		<li><?php if (isset($_SESSION['login'])) {	?>
				<a href="logout.php">Desconectar</a>
			<? }else{ ?>
				<a href="login.php">Iniciar Sesión</a>
			<?php } ?>
		</li>
		
		<li class="icon">
			<a href="javascript:void(0);" onclick="myToggleMenu()">&#9776;</a>
		</li>	
	</ul>
</nav>
