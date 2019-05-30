<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarPacientes.php"); 
		

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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
  <link rel="stylesheet" type="text/css" href="css/citas.css" />
  <script type="text/javascript" src="./js/boton.js"></script>
  <title>Historial pacientes</title>
  <?php include_once("head.php")?>
</head>

<body>
<?php
	include_once("cabecera_trabajadores.php");
?>
<main>

    <div class = "p">
        <form action="historial_paciente.php" method="post">
            <div class = "id"><label for="id">Busqueda por id del paciente: </label><input type="text" name="id" id="id" /></div>
            <input type="submit" class ="butn" name="submit" value="submit" />
            
        </form>

        <div class="tabla">
            
        </div>

        <div class="informe">
            <?php   $p = $_SESSION["paciente"]  ;
            ?>
            <form action="form_alta_informe.php">
                <input type="submit" class ="butn" name="informe" value="<?=$p['OIDHistorial']?>" />
            </form>            
        </div>
    </div>
    <?php
	include_once("pie.php");
?>
</main>

</body>
</html>

<?php
	cerrarConexionBD($conexion);
?>