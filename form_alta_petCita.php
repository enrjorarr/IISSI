
<?php
    session_start();
    
    require_once("gestionBD.php");
	if(isset($_POST["code"])){
		$code  = $_POST["code"];
	}

    if(!isset($_SESSION["formulario"])){
        $formulario['nif'] = "";                                                                       
		$formulario['motivo'] = "";                                                                
		$formulario['fecha'] = "";                                    
        $formulario['idPaciente'] = "";                                     

		$_SESSION["formulario"] = $formulario;
		$_SESSION["tipoCita"] = $code;
    }

    else{
		
        $formulario=$_SESSION["formulario"];

    }

    if(isset($_SESSION["errores"])){
        $errores = $_session["errores"];
        unset($_SESSION["errores"]);
    }

    $conexion = crearConexionBD();
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/form_alta_petCitas.css" />
  <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>-->
  <script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
  <title>Gestión de Clinica Veterinaria: Alta de Cita</title>
  <?php include_once("head.php");?>
</head>


<body>

<?php
	include_once("cabecera.php");

?>
	<script>
		// Inicialización de elementos y eventos cuando el documento se carga completamente
		$(document).ready(function() {
			$("#altaUsuario").on("submit", function() {
				return validateForm();
			});
			
			// EJERCICIO 2: Manejador de evento para copiar automáticamente el email como nick del usuario
			$("#email").on("input", function(){
				$("#nick").val($(this).val());
			});

			// EJERCICIO 3: Manejador de evento del color de la contraseña
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
	
	<form id="petCita" method="get" action="validacion_alta_petCita.php"
		>
		<!--novalidate--> 
		<!--onsubmit="return validateForm()"-->   
		<p><i>Los campos obligatorios están marcados con </i><em STYLE="color:red;">*</em></p>
		<fieldset class="datos1" ><legend>Datos de la cita</legend>

			<div><label for="fecha">Fecha solicitada :<em STYLE="color:red;">*</em></label>
			<input id="fecha" name="fecha" type="date" size="80" value="<?php echo $formulario['fecha'];?>"required/>
			</div>

			<div><label for="motivo">Motivo :<em STYLE="color:red;">*</em></label>
			<input id="motivo" name="motivo"  type="text" size="80" pattern="[A-Za-z]+" value="<?php echo $formulario['motivo'];?>" required/>
			</div>

			<div><label for="coste">Identificacion del paciente:<em STYLE="color:red;">*</em></label>
			<input id="idPaciente" name="idPaciente" type="text" pattern="^[0-9]{9}" value="<?php echo $formulario['idPaciente'];?>" required/>
			</div>




		</fieldset>

		
		<div><input class="butn" type="submit" value="Crear" /></div>
		<?php
		include_once("pie.php");
		cerrarConexionBD($conexion);
	?>

	</form>



	
	</body>
</html>

