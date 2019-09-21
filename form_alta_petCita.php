
<?php
    session_start();
    
    require_once("gestionBD.php");
	if(isset($_POST["code"])){
		$code  = $_POST["code"];
	}

    if(isset($_SESSION["formulario"])){
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
	


	function hoyFecha(){
		$aux = getdate();
		//var_dump($aux);exit;

		$dd = $aux["mday"];
		//$dd = (string)$dd;


		$mm = $aux["mon"];
		//$mm = (string)$mm;

		$yyyy = $aux["year"];
		//$yyyy = (string)$yyyy;
	 
		$dd=addZero($dd);
		$mm=addZero($mm);

			return $yyyy . '-' . $mm . '-' . $dd;
	}


	function addZero($i) {
		if ($i < 10) {
			$i = '0' . $i;
		}
		return $i;
	}
	$hoy = hoyFecha();

	$errores=array();

    if(isset($_SESSION["errores"])){
        $errores = $_SESSION["errores"];
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

  	<!--include jQuery -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"
		type="text/javascript"></script>
 
	<!--include jQuery Validation Plugin-->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"
		type="text/javascript"></script>
 
	<!--Optional: include only if you are using the extra rules in additional-methods.js -->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js"
		type="text/javascript"></script>


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
	novalidate>
		
		<!--onsubmit="return validateForm()"-->   
		<p><i>Los campos obligatorios están marcados con </i><em STYLE="color:red;">*</em></p>
		<fieldset class="datos1" ><legend>Datos de la cita</legend>

			<div><label for="fecha">Fecha solicitada :<em STYLE="color:red;">*</em></label>
			<input id="fecha" name="fecha" type="date" size="80" min="<?php echo $hoy;?>" title="Las citas no se pueden dar en el pasado :("
			value="<?php echo $formulario['fecha'];?>"required/>
			</div>

			<div><label for="motivo">Motivo :<em STYLE="color:red;">*</em></label>
			<input id="motivo" name="motivo"  type="text" size="80" pattern="[A-Za-z\s]+" value="<?php echo $formulario['motivo'];?>" required/>
			</div>

			<div><label for="idPaciente">Identificacion del paciente:<em STYLE="color:red;">*</em></label>
			<input id="idPaciente" name="idPaciente" type="text" pattern="^[0-9]{9}" title="Formato incorrecto, debe componerse de 9 dígitos"
				 value="<?php echo $formulario['idPaciente'];?>" required/>
			</div>




		</fieldset>

		
		<div><input class="butn" type="submit" value="Crear" /></div>
		<?php
		include_once("pie.php");
		cerrarConexionBD($conexion);
	?>

	</form>



	
	</body>

	<script type = "text/javascript">

		$(function(){

			$("#petCita").validate(
				{
					rules:{
						fecha:{
							required:true

						},
						motivo:{
							required:true,
							maxlength:250
						},
						idPaciente:{
							required:true,
							maxlength:9,
							minlength:9
						}
					},
					messages:{

						fecha:{
							required:"Esta casilla debe estar rellenada"

						},
						motivo:{
							required:"Esta casilla debe estar rellenada",
							maxlength:250
						},
						idPaciente:{
							required:"Esta casilla debe estar rellenada",
							maxlength:"Formato incorrecto, debe componerse de 9 dígitos",
							minlength:"Formato incorrecto, debe componerse de 9 dígitos"
						}
						
				
					}
			

				});	

			});

	
	
	</script>
</html>

