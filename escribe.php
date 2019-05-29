<?php session_start(); ?>
	

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
    <?php   $p = $_SESSION["paciente"]  ;
?>
	<h1>Esto esta o que : <?=$p['DNI']?></h1>
		
	<p>¿No estás registrado? <a href="form_alta_cliente.php">¡Registrate!</a></p>
</main>

<?php
	include_once("pie.php");
?>
</body>
</html>
