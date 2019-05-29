Dni, OIDGestor,FechaInicio, FechaFin, DuracionMin,Coste

<?php
    session_start();
    
    require_once("gestionBD.php");


    if(!isset($_SESSION["formulario"])){
        $formulario['nif'] = "";                                      //  
		$formulario['OIDGestor'] = "";                                   //
		$formulario['fechaInicio'] = "";                                //    
		$formulario['fechaFin'] = "";                          //           
		$formulario['duracionMin'] = "";                                    //
        $formulario['coste'] = "";                                     //
        

        $_SESSION["formulario"] = $formulario;
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
  <link rel="stylesheet" type="text/css" href="css/form_alta_cita.css" />
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
	
	<form id="altaCita" method="get" action="validacion_alta_cita.php"
		>
		<!--novalidate--> 
		<!--onsubmit="return validateForm()"-->   
		<p><i>Los campos obligatorios están marcados con </i><em STYLE="color:red;">*</em></p>
		<fieldset class="datos1" ><legend>Datos de la cita</legend>
			<div></div><label for="nif">DNI del cliente:<em STYLE="color:red;">*</em></label>
			<input id="nif" name="nif" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['nif'];?>" required>
			</div>

			<div><label for="OIDGestor">OID del Gestor<em STYLE="color:red;">*</em></label>
			<input id="OIDGestor" name="OIDGestor" type="number" size="40" value="<?php echo $formulario['OIDGestor'];?>" required/>
			</div>

			<div><label for="fechaInicio">Fecha de inicio:<em STYLE="color:red;">*</em></label>
			<input id="fechaInicio" name="fechaInicio" type="date" size="80" value="<?php echo $formulario['fechaInicio'];?>"required/>
			</div>

			<div><label for="fechaFin">Fecha de fin:<em STYLE="color:red;">*</em></label>
			<input type="date" id="fechaFin" name="fechaFin" value="<?php echo $formulario['fechaFin'];?>"required/>
			</div>

			<div><label for="duracionMin">Duración en minutos:<em STYLE="color:red;">*</em></label>
			<input id="duracionMin" name="duracionMin"  type="number"  value="<?php echo $formulario['duracionMin'];?>" required/>
			</div>

			<div><label for="coste">Coste:<em STYLE="color:red;">*</em></label>
			<input id="coste" name="coste" type="number" value="<?php echo $formulario['coste'];?>" required/>
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

