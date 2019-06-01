<?php
    session_start();

    require_once("gestionBD.php");
    require_once("gestionarCitas.php");
	require_once("paginacion_consulta.php");
	require_once("paginacion_trabajadores.php");


    if (!isset($_SESSION['loginTrabajador']))
		Header("Location: inicio_sesion.php");
    else {
	    if (isset($_SESSION["cita"])) {
		    $cita = $_SESSION["cita"];
		    unset($_SESSION["cita"]);
		}
		$conexion = crearConexionBD();
		if (isset($_SESSION['loginTrabajador']))	{

			$email = $_SESSION['loginTrabajador'];

			$trabajador = consultarTrabajador2email($conexion,$email);

			$oidtrabajador=$trabajador["OIDTRABAJADOR"];

			if(esVeterinario($conexion,$oidtrabajador)){


			}

			
		}	

	

        
    	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"]))
    $paginacion = $_SESSION["paginacion"];

    $pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
    $pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

    if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
    if ($pag_tam < 1) 		$pag_tam = 5;

    	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

   
    
    // La consulta que ha de paginarse
    $query1 = 'SELECT CITAS.OIDCITA, CITAS.DNI, CITAS.OIDGESTOR,CITAS.FECHAINICIO, '
    . ' CITAS.HORAINICIO, CITAS.DURACIONMIN,CITAS.COSTE '
    .' FROM CITAS '
	.' WHERE ' . 'CITAS.OIDCITA  IN 
	  (SELECT CONSULTAS.OIDCITA FROM CONSULTAS WHERE OIDVETERINARIO= :oidveterinario)'
	.' ORDER BY FECHAINICIO ';
	
	$query2='SELECT CITAS.OIDCITA, CITAS.DNI, CITAS.OIDGESTOR,CITAS.FECHAINICIO, '
    . ' CITAS.HORAINICIO, CITAS.DURACIONMIN,CITAS.COSTE '
    .' FROM CITAS,PELUQUERIAS'
	.' WHERE ' . 'CITAS.OIDCITA  IN 
	  (SELECT PELUQUERIAS.OIDCITA FROM PELUQUERIAS WHERE OIDPELUQUERO = :oidpeluquero)'
	.' ORDER BY FECHAINICIO ';

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
  <link rel="stylesheet" type="text/css" href="css/consulta_citas_cliente.css" />
  
  <title>consulta citas</title>
	<?php include_once("head.php"); ?>
  
</head>

<body>
    <?php
	    include_once("cabecera.php");
    ?>
	

    <main>

	 <table class="consulta">

     <thead>
    <tr>
    	<th>Cita</th>
    	<th>Fecha</th>
    	<th>Duración</th>
		<th>Coste</th>
		<th>Eliminar</th>
    </tr>
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



		<form method="get" action="consulta_citas.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros; ?>"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form>

	



	<?php

		foreach($filas as $fila) {

	?>



	<article class="cita">

		<form method="get" action="controlador_citas.php">

			<div class="fila_cita">

				<div class="datos_cita">

					<input id="OIDCITA" name="OIDCITA"

						type="hidden" value="<?php echo $fila["OIDCITA"]; ?>"/>

					<input id="DNI" name="DNI"

						type="hidden" value="<?php echo $fila["DNI"]; ?>"/>

					<input id="OIDGESTOR" name="OIDGESTOR"

						type="hidden" value="<?php echo $fila["OIDGESTOR"]; ?>"/>

					<input id="FECHAINICIO" name="FECHAINICIO"

						type="hidden" value="<?php echo $fila["FECHAINICIO"]; ?>"/>

					<input id="FECHAFIN" name="FECHAFIN"

						type="hidden" value="<?php echo $fila["FECHAFIN"]; ?>"/>

                    <input id="DURACIONMIN" name="DURACIONMIN"

                        type="hidden" value="<?php echo $fila["DURACIONFIN"]; ?>"/>
                    
                    <input id="COSTE" name="COSTE"

                                type="hidden" value="<?php echo $fila["COSTE"]; ?>"/>



				

						<!-- mostrando título -->

						  
						<input id="OIDCITA" name="OIDCITA" type="hidden" value="<?php echo $fila["OIDCITA"]; ?>"/>
                        <tbody>
                        <tr>
                            <td><?php echo $fila["OIDCITA"]; ?></td>
                            <td><?php echo $fila["FECHAINICIO"]; ?></td>
                            <td><?php echo $fila["DURACION"]; ?></td>
							<td><?php echo $fila["COSTE"]; ?></td>
							<td>
                                <button id="borrar" name="borrar" type="submit" class="editar_fila">
                                    <img src="images/borrar.png" class="editar_fila" alt="Borrar cita">
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

</main>


<?php
	include_once("pie.php");
?>



  

</body>
</html>