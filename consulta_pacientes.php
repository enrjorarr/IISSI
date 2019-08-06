<?php
	session_start();



	require_once ("gestionBD.php");
	require_once ("gestionarPacientes.php");
	require_once ("paginacion_consulta.php");
	require_once("gestionarClientes.php");
	
	$conexion = crearConexionBD();


if (!isset($_SESSION["formulario"])) {
                                // 
	$formulario['idPaciente'] = "";                                          
								  

	$_SESSION["formulario"] = $formulario;
}
else{
	 
	$formulario = $_SESSION["formulario"];
}		
if (isset($_SESSION["errores"])){
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}


////////////////////////////////////////////////////////////////////////////////////////////7
if (!isset($_SESSION['login']))
	Header("Location: inicio_sesion.php");
else {
	if (isset($_SESSION["paciente"])) {
		$paciente = $_SESSION["paciente"];
		unset($_SESSION["paciente"]);
	}
	if (isset($_SESSION['login']))	{

		$email = $_SESSION['login'];

		$usuario = consultarUsuario2email($conexion,$email);

		$dni = $usuario["DNI"];
	}

	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = 3;

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 3;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);


	// La consulta que ha de paginarse
    $query = 'SELECT PACIENTES.IDPACIENTE,PACIENTES.FECHANAC,PACIENTES.COLORPELO,PACIENTES.RAZA,PACIENTES.ESPECIE '
    .'FROM PACIENTES '
    .'WHERE '.' PACIENTES.DNI = :dniConsultaCita '
    .' ORDER BY IDPACIENTE ';
    
    

	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion, $query);
	$total_paginas = (int)($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0)		$total_paginas++;

	if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);

	cerrarConexionBD($conexion);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
    <link rel="stylesheet" type="text/css" href="css/consulta_pacientes.css" />
	<script type="text/javascript" src="./js/boton.js"></script>
  <?php include_once("head.php"); ?>
  <title>Gestión de veterinaria:pacientes</title>
</head>

<body>

<?php

include_once ("cabecera.php");

?>



<main>

        <table class="consulta">
            <thead>
            <tr>
                <th>ID Paciente</th>
                <th>Fecha de nacimiento</th>
                <th>Color de pelo</th>
                <th>Raza</th>
                <th>Especie</th>
                <th>DNI</th>
				<th>Eliminar</th>


            </tr>
            </thead>

            <tfoot>
                <tr>
                    <td colspan="4">
                    
                   
		            <div id="enlaces">
                        <a href="#">&laquo;</a>
			        <?php

				            for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					            if ( $pagina == $pagina_seleccionada) { 	?>

                                    <span class="current"><a class="active"><?php echo $pagina; ?></a></span>
                        

			                <?php }	else { ?>

						            <a class="active" href="consulta_pacientes.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			                <?php } ?>
                            <a href="#">&raquo;</a>
                 </div>
                 </td>
                </tr>
            </tfoot>

    

        

		<form method="get" action="consulta_pacientes.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="3"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form>
     
    

   



	<?php

		foreach($filas as $fila) {

    ?>
    
            
    
       
	<article class="paciente">

		<form method="get" action="controlador_pacientes.php">

			<div class="fila_paciente">

				<div class="datos_paciente">

					<input id="DNI" name="DNI"

						type="hidden" value="<?php echo $dni; ?>"/>

					<input id="IDPACIENTE" name="IDPACIENTE"

						type="hidden" value="<?php echo $fila["IDPACIENTE"]; ?>"/>

					<input id="FECHANAC" name="FECHANAC"

						type="hidden" value="<?php echo $fila["FECHANAC"]; ?>"/>

					<input id="COLORPELO" name="COLORPELO"

						type="hidden" value="<?php echo $fila["COLORPELO"]; ?>"/>

					<input id="RAZA" name="RAZA"

						type="hidden" value="<?php echo $fila["RAZA"]; ?>"/>
                    
                    <input id="ESPECIE" name="ESPECIE"

						type="hidden" value="<?php echo $fila["ESPECIE"]; ?>"/>

 

			

                    
                   

						<!-- mostrando título -->
                        
						<input id="IDPACIENTE" name="IDPACIENTE" type="hidden" value="<?php echo $fila["IDPACIENTE"]; ?>"/>
                        <tbody>
                        <tr>
                            <td><?php echo $fila["IDPACIENTE"]; ?></td>
                            <td><?php echo $fila["FECHANAC"]; ?></td>
                            <td><?php echo $fila["COLORPELO"]; ?></td>
                            <td><?php echo $fila["RAZA"]; ?></td>
                            <td> <?php echo $fila["ESPECIE"]; ?></td>
                            <td><?php echo $dni; ?></td>
							<td>
                                <button id="borrar" name="borrar" type="submit" class="editar_fila">
                                    <img src="images/borrar.png" class="editar_fila" alt="Borrar">
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    
            </div>



				
			</div>

		</form>

    </article>
  
    
    



    <?php } ?>
    
    </table>
	<div class="anadirpaciente">
		<form id="altaPaciente" method="post" action="form_alta_paciente.php">
			<input class="butn" type="submit" value="Añadir mascota" />
		</form>
	</div>
	<!-- <div class="eliminarpaciente"> -->
		<!-- <form id="formulario" name="formulario" action="validacion_eliminar_paciente.php" method="post"> -->
            <!-- <div class = "eliminarPaciente"> -->
				<!-- <h3>Puede eliminar su mascota si aún no ha reservado o ha sido atendida en consulta</h3> -->
                <!-- <label for="eliminarPaciente">Insertar id del paciente: </label> -->
				<!-- <input type="text" name="id" id="id" pattern="^[0-9]{9}"/> -->
                <!-- <input type="submit" class ="butn" name="Eliminar mascota" value="Eliminar mascota" />
            </div>
        </form>
	</div> -->

</main>



<?php

include_once ("pie.php");
?>

</body>

</html>