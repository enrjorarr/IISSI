<?php
    session_start();
    
    require_once("gestionBD.php");
	require_once("gestionarClientes.php"); 
    $email = $_SESSION["login"];

	$conexion = crearConexionBD(); 

    $cliente = consultarUsuario2email($conexion,$email);

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
  <link rel="stylesheet" type="text/css" href="css/informacion_personal.css" />
	
  <title>Sobre nosotros</title>
  <?php include_once("head.php");?>

</head>

<body>
<?php	

include_once("cabecera.php"); 
?>

<main>


<div class="p">
	<div class = "p1">
    <form id="modificacionCliente" method="post" action="form_modificacion_cliente.php"
		>
		<!--novalidate--> 
		<!--onsubmit="return validateForm()"-->   
		<fieldset class="datos1" ><legend>Datos personales</legend>

            <div>
                <p>DNI: <?php echo $cliente['DNI'];?> </p>
            </div>

			<div>
                <p>Nombre: <?php echo $cliente['NOMBRE'];?></p>
            </div>

			<div>
                <p>Apellidos: <?php echo $cliente['APELLIDOS'];?></p>
            </div>
            
            <div>
                <p>Fecha de nacimiento: <?php echo $cliente['FECHANAC'];?></p>
            </div>
            
			<div>
                <p>Numero de teléfono: <?php echo $cliente['NUMEROTELEFONO'];?></p>
            </div>

            <div>
                <p>Email: <?php echo $cliente['EMAIL'];?></p>
            </div>

            <div>
                <p>Dirección: <?php echo $cliente['DIRECCION'];?></p>
			</div>
		</fieldset><br>

		<div><input class="butn" type="submit" value="Modificar" /></div>
		

	</form>

	</div>
	<div class = "p2">
	</div>
</div>

</main>

<?php	
	include_once("pie.php");
?>		
</body>
</html>
