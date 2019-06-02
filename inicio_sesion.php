<?php
	session_start();
   
	include_once("gestionBD.php");
	include_once("gestionarClientes.php");
	include_once("gestionarTrabajadores.php");
	 
	 if (isset($_POST['submit'])){
		 $email= $_POST['email'];
		 $pass = $_POST['pass'];
		 $num_usuarios = 0;
		 $conexion = crearConexionBD();
 
		 if(existeCliente($conexion,$email,$pass)){
 
				 
			 $_SESSION['login'] = $email;
			 Header("Location: inicio.php");
			 cerrarConexionBD($conexion);
			 
	 }elseif(existeTrabajador($conexion,$email,$pass)){
 
			 $miscojones = consultarTrabajador2email($conexion,$email);
			 $vergota = $miscojones["ESGESTOR"];
 
				 if($vergota == "s"){
					 $_SESSION['loginGestor'] = $email;
					 Header("Location: inicio_gestor.php");
				 }else{
					 $_SESSION['loginTrabajador'] = $email;
					 Header("Location: inicio_trabajador.php");
				 }
 
			 cerrarConexionBD($conexion);	
	 
			 
		 }	
	 else{
	   if ($num_usuarios == 0)
		 $login = "error";	
		 else {
		 $_SESSION['login'] = $email;
				 Header("Location: inicio_sesion.php");
			 }
		 }
	 }
 
 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/inicio_sesion.css" />
  <title>Gestión de clinica: Inicio Sesión</title>
  <?php include_once("head.php")?>
</head>

<body>

<?php
	include_once("cabecera.php");

?>

<main>
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}	
	?>
	
	<!-- The HTML login form -->
	<form action="inicio_sesion.php" method="post">
		<div class = "email"><label for="email">Email: </label><input type="text" name="email" id="email" /></div>
		<div class="pass"><label for="pass">Contraseña: </label><input type="password" name="pass" id="pass" /></div>
		<input type="submit" class ="butn" name="submit" value="iniciar sesión" />
	</form>
		
	<p>¿No estás registrado? <a href="form_alta_cliente.php">¡Registrate!</a></p>
</main>

<?php
	include_once("pie.php");
?>
</body>
</html>

