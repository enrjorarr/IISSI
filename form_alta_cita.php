

<?php
    session_start();
    
	require_once("gestionBD.php");
	require_once("gestionarCitas.php");
	require_once("gestionarTrabajadores.php");


    if(!isset($_SESSION["formulario"])){
        $formulario['nif'] = "";                                     
		$formulario['OIDGestor'] = "";                                   
		$formulario['fechaInicio'] = "";                                   
		$formulario['horaInicio'] = "";                                     
		$formulario['duracionMin'] = "";                                    
		$formulario['coste'] = ""; 
		$formulario['oidTrabajador'] = "";                                     
		
        

        $_SESSION["formulario"] = $formulario;
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

	//___________________________________________________________________________________________________________________
	$conexion = crearConexionBD();
	$emailTrabajador=$_SESSION["loginGestor"];
	$trabajador = consultarTrabajador2email($conexion,$emailTrabajador);

	$oidTrabajador = $trabajador["OIDTRABAJADOR"];
	$gestor = consultarGestor2OIDTrabajador($conexion,$oidTrabajador);
	$OIDGestor = $gestor["OIDGESTOR"];
	

	//___________________________________________________________________________________________________________________
	$errores = array();
    if(isset($_SESSION["errores"])){
        $errores =  $_SESSION["errores"];
        unset($_SESSION["errores"]);
	}
	




	

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
  <?php include_once("head_staff.php");?>

  
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
	include_once("cabecera_gestor.php");

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
	
	<form id="altaCita" method="get" action="validacion_alta_cita.php" 
		>
		<!--novalidate--> 
		<!--onsubmit="return validateForm()"-->   
		<p><i>Los campos obligatorios están marcados con </i><em STYLE="color:red;">*</em></p>
		<fieldset class="datos1" ><legend>Datos de la cita</legend>
			<div></div><label for="nif">DNI del cliente:<em STYLE="color:red;">*</em></label>
			<input id="nif" name="nif" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['nif'];?>" required>
			</div>

			<div><label for="fechaInicio">Fecha de inicio:<em STYLE="color:red;">*</em></label>
			<input id="fechaInicio" name="fechaInicio" type="date" size="80" min=<?php echo $hoy;?> value="<?php echo $formulario['fechaInicio'];?>"required/>
			</div>
		
			<div><label for="horaInicio">Hora de Inicio:<em STYLE="color:red;">*</em></label>
			<input type="text" id="horaInicio" name="horaInicio" pattern="^(?:0?[1-9]|1[0-2]):[0-5][0-9]\s?(?:[aApP](\.?)[mM]\1)?$"
			 title="Debe con usarse el siguiente formato HH:mm "
				value="<?php echo $formulario['horaInicio'];?>"required/>
			</div>

			<div><label for="duracionMin">Duración en minutos:<em STYLE="color:red;">*</em></label>
			<input id="duracionMin" name="duracionMin"  type="number" title="Debe insertar un número" value="<?php echo $formulario['duracionMin'];?>" required/>
			</div>
 
			<div><label for="tipoCita">Tipo de Cita:<em STYLE="color:red;">*</em></label>
			<select name="tipoCita">
                <option type="text" value="c">Consulta</option>
                <option type="text" value="p">Peluquería</option>
        	</select>
            </div>

			<div><label for="coste">Coste:<em STYLE="color:red;">*</em></label>
			<input id="coste" name="coste" type="number" value="<?php echo $formulario['coste'];?>" required/>
			</div>

			<div><label for="oidTrabajador">OID Trabajador:<em STYLE="color:red;">*</em></label>
			<input id="oidTrabajador" name="oidTrabajador" type="number" value="<?php echo $formulario['OIDTrabajador'];?>" required/>
			</div>

			<div>
				<input id="OIDGestor" name="OIDGestor" type="hidden" value="<?php echo $formulario['OIDGestor'];?>" required/>
			</div>

		

			

		</fieldset>

		<div class="vali">
    			<a href="http://jigsaw.w3.org/css-validator/check/referer">
        		<img style="border:0;width:88px;height:31px"
            	src="http://jigsaw.w3.org/css-validator/images/vcss"
            	alt="¡CSS Válido!" />
    			</a>
		</div>

		
		<div><input class="butn" id="boton" type="submit" value="Crear" /></div>

		
	<?php
		include_once("pie.php");
		cerrarConexionBD($conexion);
	?>
	
	</form>

	

	
	</body>

	

	<script type = "text/javascript">

		$(function(){

			$("#altaCita").validate(
				{
					rules:{
						nif:{
							required:true,
						},

						fechaInicio:{
							required:true
						 },

						 horaInicio:{
							 required:true
						 },

						
						duracionMin:{
							required:true,
							min:15,
							max:59
						},
						coste:{
							required:true,
							min:0	
						},
						oidTrabajador:{
							required:true,
							maxlength:2,
							minlength:1
						}
					},
					messages:{
						nif:{
							required:"Por favor introduzca su nif",
						},

						

						fechaInicio:{
							required:"Este campo debe estar completo"
						},

						
						horaInicio:{
							 required:"Este campo debe estar completo"
						 },

						duracionMin:{
							required:"Debe contener un número",
							min:"La duración minima es de 15 minutos",
							max:"La duración maxima es de 59 minutos"
						},
						oidTrabajador:{
							required:"Esta casilla debe estar completada",
							maxlength:"El número debe estar compuesto de 1 a 2 dígitos",
							minlength:"El número debe estar compuesto de 1 a 2 dígitos"

						},
						coste:{
							required:"Este campo debe estar completo",
							min:"No se admiten precios negativos"	
						}

				
					}
			

				});	

			});

	
	
	</script>
</html>

