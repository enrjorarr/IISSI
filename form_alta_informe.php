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
	//var_dump($hoy);exit;

	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	$errores = array();

	
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
  <?php include_once("head_staff.php");?>

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
		  
	    <form id="altaInforme" method="get" action="validacion_alta_informe.php" novalidate
		    >
		    <!--novalidate--> 
            <!--onsubmit="return validateForm()"--> 
            
                <div class = "fechaConsulta">
		  			
                    <label for="fechaConsulta">Fecha de Consulta:</label>
			        <input type="date" id="fechaConsulta" name="fechaConsulta" max=<?php echo $hoy;?> value="<?php echo $formulario['fechaConsulta'];?>"/>
                </div>
                
                <div class = "motivo">
                    <label for="motivo">Motivo: </label>
                    <input type="text" name="motivo" id="motivo" style="width:25%"  pattern="[A-Za-z\s]+" value="<?php echo $formulario['motivo'];?>" required/>
                </div>

		        <div class="tratamiento">
                    <label for="tratamiento">Tratamiento: </label>
                    <input type="text" name="tratamiento" id="tratamiento" style="width:22%" pattern="[A-Za-z\s]+" value="<?php echo $formulario['tratamiento'];?>" required/>
				</div>
				
				<div class="OIDHistorial">
                    <label for="OIDHistorial">OIDHistorial: </label>
                    <input type="text" name="OIDHistorial" id="OIDHistorial" style="width:22%" pattern="[0-9]+" value="<?php echo $formulario['OIDHistorial'];?>" required/>
                </div>

                

		    <div><input class="butn" type="submit" value="Enviar" /></div>
		    

	    </form>
    </main>

    <?php
		    include_once("pie.php");
		    cerrarConexionBD($conexion);
	    ?>
	
	</body>
	<script type = "text/javascript">

		$(function(){

			$("#altaInforme").validate(
				{
					rules:{
						fechaConsulta:{
							required:true

						},

						motivo:{
							required:true
						 },

						 tratamiento:{
							required:true
						},
						
						OIDHistorial:{
							required:true,
							maxlength:1,
							minlength:1
						}
					
					},
					messages:{
						fechaConsulta:{
							required:"Debe insertar la fecha de la consulta"

						},

						motivo:{
							required:"Introduzca el motivo"
						 },

						 especie:{
							required:"Introduzca la especie"
						},
						
						tratamiento:{
							required:"Introduzca el tratamiento",
						},
						OIDHistorial:{
							required:"El id debe contener 1 dígito",
							maxlength:"El número debe estar compuesto de 1 dígito",
							minlength:"El número debe estar compuesto de 1 dígito"

						}
				
					}
			

				});	

			});

	
	
	</script>

</html>
