<?php
    session_start();

    require_once("gestionBD.php");
    require_once("gestionarTrabajadores.php");
    require_once("paginacion_consulta.php");

    if (!isset($_SESSION['login']))
		Header("Location: inicio_sesion.php");
    else {
	    if (isset($_SESSION["trabajador"])) {
		    $trabajador = $_SESSION["trabajador"];
		    unset($_SESSION["trabajador"]);
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

    $conexion = crearConexionBD();
    
    // La consulta que ha de paginarse
    $query = 'SELECT TRABAJADORES.OIDTRABAJADOR, TRABAJADORES.PASS,TRABAJADORES.FECHANAC,'
    .'TRABAJADORES.NOMBRE, TRABAJADORES.APELLIDOS, TRABAJADORES.DIRECCION,TRABAJADORES.EMAIL,'
    .'TRABAJADORES.HORASTRABAJO,TRABAJADORES.SUELDO,TRABAJADORES.ESGESTOR, TRABAJADORES.DNI'
    .' FROM TRABAJADORES, PELUQUEROS, VETERINARIOS ';

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
	<?php include_once("head_staff.php"); ?>
  
</head>

<body>
    <?php
	    include_once("cabecera_gestor.php");
    ?>
	<div class="todo">

  

    <main>

	 <table class="consulta">

     <thead>
    <tr>
    	<th>OID Trabajador</th>
		<th>Nombre</th>
		<th>Apellidos</th>
    	<th></th>
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

					<input id="HORAINICIO" name="HORAINICIO"

						type="hidden" value="<?php echo $fila["HORAINICIO"]; ?>"/>

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
							<td><?php echo $fila["HORAINICIO"]; ?></td>
							<td><?php echo $fila["DURACION"]; ?></td>
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