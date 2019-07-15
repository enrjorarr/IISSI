<?php
	session_start();
	
	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");
	require_once("gestionarClientes.php"); 



	//require_once("gestionar_direcciones.php");
	//require_once("gestionar_generos_literarios.php");
	
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION["formulario"])) {

		$formulario['nif'] = "";                                      //   
		$formulario['fechaNacimiento'] = "";                          //           
		$formulario['colorPelo'] = "";                                    //
		$formulario['especie'] = "";                                     //
		$formulario['raza'] = "";                                    // 
        $formulario['idPaciente'] = "";                                          
                                      
	
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
  <link rel="stylesheet" type="text/css" href="css/form_alta_cliente.css" />
  <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>-->
  <script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
  <title>Gestión de Clinica Veterinaria: Alta Paciente</title>
  <?php include_once("head.php");?>
</head>

<body>

<?php
	include_once("cabecera.php");

?>
	<script>
			$("#pass").on("keyup", function() {
				// Calculo el color
				passwordColor();
			});

	</script>
	

	
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
	
	<form id="altaPaciente" method="get" action="validacion_alta_paciente.php"
		>
		<!--novalidate--> 
		<!--onsubmit="return validateForm()"-->   
		<p><i>Los campos obligatorios están marcados con </i><em STYLE="color:red;">*</em></p>

		<fieldset class="datos2"><legend>Datos del paciente</legend>
            <div><label for="fechaNacimiento">Fecha de nacimiento:<em STYLE="color:red;">*</em></label>
			<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $formulario['fechaNacimiento'];?>"/>
			</div>
			<div><label for="colorPelo">Color de pelo.:<em STYLE="color:red;">*</em></label>
			<input id="colorPelo" name="colorPelo" type="text" size="40" pattern="[A-Za-z\s]+" value="<?php echo $formulario['colorPelo'];?>" required/>
			</div>        
            <div><label for="especie">Especie:<em STYLE="color:red;">*</em></label>
			<input id="especie" name="especie" type="text" size="40" pattern="[A-Za-z\s]+" value="<?php echo $formulario['especie'];?>" required/>
			</div>
            <div><label for="raza">Raza:</label>
			<input id="raza" name="raza" type="text" size="40" pattern="[A-Za-z\s]+" value="<?php echo $formulario['raza'];?>" required/>
			</div>
            <div><label for="idPaciente">ID del Paciente:<em STYLE="color:red;">*</em></label>
			<input id="idPaciente" name="idPaciente" type="text" pattern="^[0-9]{9}" value="<?php echo $formulario['idPaciente'];?>" required/>
			</div>

		</fieldset>

		<div><input class="butn" type="submit" value="Enviar" /></div>
		<?php
		include_once("pie.php");
		cerrarConexionBD($conexion);
	?>

	</form>



	
	</body>
</html>