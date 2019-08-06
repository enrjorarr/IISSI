

<?php
    session_start();
    
	require_once("gestionBD.php");
	require_once("gestionarCitas.php");
	require_once("gestionarTrabajadores.php");



	//___________________________________________________________________________________________________________________
	$errores = array();
    if(isset($_SESSION["errores"])){
        $errores =  $_SESSION["errores"];
        unset($_SESSION["errores"]);
	}
	


	$conexion = crearConexionBD();

	

    ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/form_alta_cita.css" />
  <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>-->
  <link href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap" rel="stylesheet">
  <script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
  <title>Gestión de Clinica Veterinaria: Alta de Cita</title>
  <?php include_once("head_staff.php");?>
</head>


<body>

<?php
	include_once("cabecera_gestor.php");

?>

	

	
	<?php 
	    
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\" style=\"margin-top:20%\">";
			echo "<div id =\"Obj1\" class = \"error\" style=\"font-family: 'ABeeZee', sans-serif;\">><h1> Errores en el formulario:</h1>";echo "</div>";
    		foreach($errores as $error){
    			echo $error;
			} 
			
			echo "</div>";
  		}
	?>
	

	<?php
		include_once("pie.php");
		cerrarConexionBD($conexion);
	?>


	
	</body>
</html>

