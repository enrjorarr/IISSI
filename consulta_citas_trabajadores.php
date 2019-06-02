<?php
    session_start();

    require_once("gestionBD.php");
	require_once("gestionarCitas.php");
	require_once("gestionarTrabajadores.php");
	require_once("paginacion_consulta.php");


    if (!isset($_SESSION['loginTrabajador']))
		Header("Location: inicio_sesion.php");
    else {
	    if (isset($_SESSION["cita"])) {
		    $cita = $_SESSION["cita"];
		    unset($_SESSION["cita"]);
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

	$conexion = crearConexionBD();
	


		$query = 'SELECT CITAS.OIDCITA, CITAS.DNI, CITAS.OIDGESTOR,CITAS.FECHAINICIO, '
		. ' CITAS.HORAINICIO, CITAS.DURACIONMIN,CITAS.COSTE '
		.' FROM CITAS';

	

	

   
    
    // La consulta que ha de paginarse
    

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
  <link rel="stylesheet" type="text/css" href="css/consultar_citas_trabajadores.css" />
  
  <title>consulta citas</title>
	<?php include_once("head_staff.php"); ?>
  
</head>

<body>
    <?php
	    include_once("cabecera_trabajadores.php");
    ?>
	

    <main>

	 <table class="consulta">

     <thead>
    <tr>
    	<th>Cita</th>
        <th>Fecha</th>
        <th>Hora</th>
    	<th>Duración</th>
        <th>Coste</th>
       
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

						            <a class="active" href="consulta_citas_trabajadores.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			                <?php } ?>
                            <a href="#">&raquo;</a>
                 </div>
                 </td>
                </tr>
            </tfoot>



		<form method="get" action="consulta_citas_trabajadores.php">

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

					<input id="HORAINICIO" name="HORAINICIO"

						type="hidden" value="<?php echo $fila["HORAINICIO"]; ?>"/>

                    <input id="DURACIONMIN" name="DURACIONMIN"

                        type="hidden" value="<?php echo $fila["DURACIONMIN"]; ?>"/>
                    
                    <input id="COSTE" name="COSTE"

                                type="hidden" value="<?php echo $fila["COSTE"]; ?>"/>



				

						<!-- mostrando título -->

						  
						<input id="OIDCITA" name="OIDCITA" type="hidden" value="<?php echo $fila["OIDCITA"]; ?>"/>
                        <tbody>
                        <tr>
                            <td><?php echo $fila["OIDCITA"]; ?></td>
                            <td><?php echo $fila["FECHAINICIO"]; ?></td>
                            <td><?php echo $fila["HORAINICIO"]; ?></td>
                            <td><?php echo $fila["DURACIONMIN"]; ?></td>
                            <td><?php echo $fila["COSTE"]; ?></td>


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