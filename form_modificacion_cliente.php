<?php
	session_start();
	
	// Importar librerías necesarias para gestionar direcciones y géneros literarios
	require_once("gestionBD.php");
	//require_once("gestionarClientes.php");
	
    // Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
    //$email = $_SESSION["login"];


    //$cliente = consultarUsuario2email($conexion,$email);
    
	if (!isset($_SESSION["formulario"])) {
		$formulario['nombre'] = "";                                   //
		$formulario['apellidos'] = "";                                //    
        $formulario['pass'] = "";                                    //
        $formulario['numeroTelefono'] = "";                                          
		$formulario['calle'] = "";                                    // 
                                      
	
		$_SESSION["formulario"] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else{
		
		$formulario = $_SESSION["formulario"];
	}	
	$errores = array();	
	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
	}
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
	
	<form id="modificacionCliente" method="get" action="validacion_modificacion_cliente.php" >
		<!--novalidate--> 
		<!--onsubmit="return validateForm()"-->   
		<p><i>Los campos obligatorios están marcados con </i><em STYLE="color:red;">*</em></p>
		<fieldset class="datos1" ><legend>Datos personales</legend>

			<div><label for="nombre">Nombre:<em STYLE="color:red;">*</em></label>
			<input id="nombre" name="nombre" type="text" size="40" pattern="[A-Za-z\s]+" value="<?php echo $formulario['nombre'];?>" required/>
			</div>

			<div><label for="apellidos">Apellidos:</label>
			<input id="apellidos" name="apellidos" type="text" size="80" pattern="[A-Za-z\s]+" value="<?php echo $formulario['apellidos'];?>"/>
			</div>

			<div><label for="numeroTelefono">Telefono:<em STYLE="color:red;">*</em></label>
			<input id="numeroTelefono" name="numeroTelefono" type="text" size="9" pattern="^[0-9]{9}"value="<?php echo $formulario['numeroTelefono'];?>" required/>
			</div>

		</fieldset>

		<fieldset class="datos2"><legend>Contraseña</legend>
			
		
			<div><label for="pass">Password:<em STYLE="color:red;">*</em></label>
                <input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres entre letras y dígitos" required oninput="passwordValidation(); "/>
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
</html>
