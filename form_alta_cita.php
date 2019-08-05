

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

	$emailTrabajador=$_SESSION["loginGestor"];
	$trabajador = consultarTrabajador2email($conexion,$email);
	$oidTrabajador = $trabajador["OIDTrabajador"];
	$gestor = consultarGestor2OIDTrabajador($conexion,$oidTrabajador);
	$OIDGestor = $trabajador["OIDGestor"];

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
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error){
    			echo $error;
			} 
    		echo "</div>";
  		}
	?>
	
	<form id="altaCita" method="get" action="validacion_alta_cita.php"  novalidate
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
			<input type="text" id="horaInicio" name="horaInicio" pattern = "/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/" value="<?php echo $formulario['horaInicio'];?>"required/>
			</div>

			<div><label for="duracionMin">Duración en minutos:<em STYLE="color:red;">*</em></label>
			<input id="duracionMin" name="duracionMin"  type="number"  value="<?php echo $formulario['duracionMin'];?>" required/>
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

		
		<div><input class="butn" type="submit" value="Crear" /></div>
	
	</form>

	<?php
		include_once("pie.php");
		cerrarConexionBD($conexion);
	?>


	
	</body>
</html>

