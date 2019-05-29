<?php
	session_start();
	
	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");
	//require_once("gestionar_direcciones.php");
	//require_once("gestionar_generos_literarios.php");
	
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION["formulario"])) {
		$formulario['fechaConsulta'] = "";                                      //  
		$formulario['motivo'] = "";                                   //
		$formulario['tratamiento'] = "";                                //    
		$formulario['OIDHistorial'] = "";                          //           
                                        
                                      
	
		$_SESSION["formulario"] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else{
		
		$formulario = $_SESSION["formulario"];
	}		
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
	}
		
	// Creamos una conexión con la BD
	$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/informe_paciente.css" />
  <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>-->
  <script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
  <title>Alta Informe</title>
  <?php include_once("head.php");?>
</head>

<body>

<?php
	include_once("cabecera_trabajadores.php");

?>	

	
	<?php 
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error){
    			echo $error;
			} 
    		echo "</div>";
  		}
	?>
	<main>

	    <form id="altaInforme" method="get" action="validacion_alta_informe.php"
		    >
		    <!--novalidate--> 
            <!--onsubmit="return validateForm()"--> 
            
                <div class = "fechaConsulta">
                    <label for="fechaConsulta">Fecha de Consulta:</label>
			        <input type="date" id="fechaConsulta" name="fechaConsulta" value="<?php echo $formulario['fechaConsulta'];?>"/>
                </div>
                
                <div class = "motivo">
                    <label for="motivo">Motivo: </label>
                    <input type="text" name="motivo" id="motivo" style="width:25%" value="<?php echo $formulario['motivo'];?>" required/>
                </div>

		        <div class="tratamiento">
                    <label for="tratamiento">Tratamiento: </label>
                    <input type="text" name="tratamiento" id="tratamiento" style="width:22%" value="<?php echo $formulario['tratamiento'];?>" required/>
                </div>

                

		    <div><input class="butn" type="submit" value="Enviar" /></div>
		    

	    </form>
    </main>

    <?php
		    include_once("pie.php");
		    cerrarConexionBD($conexion);
	    ?>
	
	</body>
</html>
