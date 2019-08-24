<?php
	session_start();
	
	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");
	//require_once("gestionar_direcciones.php");
	//require_once("gestionar_generos_literarios.php");
	
	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
	if (!isset($_SESSION["formulario"])) {
		$formulario['nif'] = "";                                      //  
		$formulario['nombre'] = "";                                   //
		$formulario['apellidos'] = "";                                //    
		$formulario['fechaNacimiento'] = "";                          //           
		$formulario['email'] = "";                                    //
		$formulario['pass'] = "";                                     //
		$formulario['calle'] = "";                                    // 
		$formulario['numeroTelefono'] = "";                                          
                                      
	
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
  <link rel="stylesheet" type="text/css" href="css/form_alta_cliente.css" />
  <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>-->
  <script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
  <title>Gestión de Clinica Veterinaria: Alta de Cliente</title>
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
	
	<form id="altaCliente" method="get" action="validacion_alta_cliente.php" >
			// novalidate> 
		<!--onsubmit="return validateForm()"-->   
		<p><i>Los campos obligatorios están marcados con </i><em STYLE="color:red;">*</em></p>
		<fieldset class="datos1" ><legend>Datos personales</legend>
			<div></div><label for="nif">DNI:<em STYLE="color:red;">*</em></label>
			<input id="nif" name="nif" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['nif'];?>" required>
			</div>

			<div><label for="nombre">Nombre:<em STYLE="color:red;">*</em></label>
			<input id="nombre" name="nombre" type="text" size="80" pattern="[A-Za-z\s]+" value="<?php echo $formulario['nombre'];?>" required/>
			</div>

			<div><label for="apellidos">Apellidos:</label>
			<input id="apellidos" name="apellidos" type="text" size="80" pattern="[A-Za-z\s]+" value="<?php echo $formulario['apellidos'];?>"/>
			</div>

			<div><label for="fechaNacimiento">Fecha de nacimiento:<em STYLE="color:red;">*</em></label>
			<input type="date" id="fechaNacimiento" name="fechaNacimiento" max=<?php echo $hoy;?> value="<?php echo $formulario['fechaNacimiento'];?>"required/>
			</div>

			<div><label for="email">Email:<em STYLE="color:red;">*</em></label>
			<input id="email" name="email"  type="email" placeholder="usuario@dominio.extension" value="<?php echo $formulario['email'];?>" required/>
			</div>

			<div><label for="numeroTelefono">Telefono:<em STYLE="color:red;">*</em></label>
			<input id="numeroTelefono" name="numeroTelefono" type="text" size="9" pattern="^[0-9]{9}"value="<?php echo $formulario['numeroTelefono'];?>" required/>
			</div>

		</fieldset>

		<fieldset class="datos2"><legend>Contraseña</legend>
			
			
			<div><label for="pass">Password:<em STYLE="color:red;">*</em></label>
                <input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres entre letras y dígitos" 
				title="Mínimo 8 caracteres entre letras y dígitos" required oninput="passwordValidation(); "/>
			</div>
			<div><label for="confirmpass">Confirmar Password: </label>
				<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña"  oninput="passwordConfirmation();""required"/>
			</div>
		</fieldset>

		<fieldset class="datos3">
			<legend>
				Dirección
			</legend>

			<div><label for="calle">Calle/Avda.:<em STYLE="color:red;">*</em></label>
			<input id="calle" name="calle" type="text" size="80" pattern="[A-Za-z\s]+" value="<?php echo $formulario['calle'];?>" required/>
			</div>
		</fieldset>

		<div><input class="butn" type="submit" value="Enviar" /></div>
		<?php
		include_once("pie.php");
		cerrarConexionBD($conexion);
	?>

	</form>



	
	</body>

	<script type = "text/javascript">

		$(function(){

			$("#altaCliente").validate(
				{
					rules:{
						nif:{
							required:true
							
							},

						nombre:{
							required:true
						 },

						apellidos:{
							required:true
						},
						fechaNacimiento:{
							required:true

						},
						email:{
							required:true,
							email:true
						},
						numeroTelefono:{
							required:true,
							maxlength:9,
							minlength:9
						},
						pass:{
							required:true,
							minlength:8,
							maxlength:20
							
						},
						confirmpass:{
							required:true,
							equalTo:"#pass"
						},
						calle:{
							required:true
						}
					},
					messages:{
						nif:{
	
							required:"Por favor introduzca su nif"
						
						
						},

						nombre:{
							required:"Introduzca su nombre"
						 },

						apellidos:{
							required:"Introduzca su apellido"
						},
						fechaNacimiento:{
							required:"Debe insertar su fecha de nacimiento"

						},
						email:{
							required:"Esta casilla debe estar completada",
							email:"Debe completar esta casilla con un email"
						},
						numeroTelefono:{
							required:"Esta casilla debe estar completada",
							maxlength:"El número debe estar compuesto de 9 dígitos",
							minlength:"El número debe estar compuesto de 9 dígitos"

						},
						pass:{
							required:"Esta casilla debe estar completada",
							minlenght:"La contraseña es muy corta",
							maxlength:"La contraseña es muy larga"
						},
						confirmpass:{
							required:"Esta casilla debe estar completada",
							equalTo:"Ambas contraseñas deben ser iguales"
						},
						calle:{
							required:"Esta casilla debe estar completada"
						}
				
					}
			

				});	

			});

	
	
	</script>

</html>