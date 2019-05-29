<?php
	session_start();
  	
  	require_once("gestionBD.php");
    require_once("gestionarPacientes.php");
    
    function consultarPacientes2ID($conexion,$id) {
     $consulta = "SELECT * FROM Pacientes WHERE IDPaciente=:id";
     $stmt = $conexion->prepare($consulta);
     $stmt->bindParam(':id',$id);
     
     $stmt->execute();
     return $stmt->fetch();
     }

	if (isset($_POST['submit'])){
		$id= $_POST['id'];
		$conexion = crearConexionBD();
        $paciente = consultarPacientes2ID($conexion,$id);
		cerrarConexionBD($conexion);	
        
		if ($paciente == null)
			$login = "error";	
		else {
        
			$_SESSION['paciente'] = $paciente;
			Header("Location: escribe.php");
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
	
    <form action="testeando.php" method="post">
        <div class = "is"><label for="id">ID: </label><input type="text" name="id" id="id" /></div>
        <input type="submit" class ="butn" name="submit" value="submit" />
    </form>
    
</main>

<?php
	include_once("pie.php");
?>
</body>
</html>
