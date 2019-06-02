<?php
    session_start();

    require_once("gestionBD.php");
    require_once("gestionarInformes.php");
    require_once("gestionarHistorial.php");
    require_once("paginacion_informe.php");

    if (!isset($_SESSION['login']))
	Header("Location: inicio_trabajador.php");
    else {
	    if (isset($_SESSION["informe"])) {
		    $informe = $_SESSION["informe"];
		    unset($_SESSION["informe"]);
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
    
    // La consulta que ha de paginarse
    $query = ' SELECT INFORME.FECHACONSULTA, INFORME.MOTIVO, INFORME.TRATAMIENTO, INFORME.OIDINFORME,'
    .' FROM INFORME '
    .'ORDER BY FECHACONSULTA';


    $query1 = 'SELECT CITAS.OIDCITA, CITAS.DNI, CITAS.OIDGESTOR,CITAS.FECHAINICIO, '
    . 'CITAS.FECHAFIN, CITAS.DURACIONMIN,CITAS.COSTE '
    .' FROM CITAS '
    .' WHERE ' . ' CITAS.DNI = CLIENTE.DNI '
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
  <link rel="stylesheet" type="text/css" href="css/perfil_usuario.css" />
  
  <title>consulta citas</title>

  
</head>

<body>
  

    <main>

	 <table class="consulta">

     <thead>
    <tr>
    <th>Cita</th>
    <th>Fecha</th>
    <th>Duración</th>
    <th>Coste</th>
    </tr>

    
		<div id="links">

			<?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="perfil_cliente_prueba.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>

		</div>



		<form method="get" action="perfil_cliente_prueba.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="3"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form>

	</nav>



	<?php

		foreach($filas as $fila) {

	?>



	<article class="cita">

		<form method="post" action="controlador_informe.php">

			<div class="fila_cita">

				<div class="datos_cita">

					<input id="FECHACONSULTA" name="FECHACONSULTA"

						type="hidden" value="<?php echo $fila["FECHACONSULTA"]; ?>"/>

					<input id="MOTIVO" name="MOTIVO"

						type="hidden" value="<?php echo $fila["MOTIVO"]; ?>"/>

					<input id="TRATAMIENTO" name="TRATAMIENTO"

						type="hidden" value="<?php echo $fila["TRATAMIENTO"]; ?>"/>

					<input id="OIDINFORME" name="OIDINFORME"

						type="hidden" value="<?php echo $fila["OIDINFORME"]; ?>"/>


				<?php

					if (isset($informe) and ($informe["INFORME"] == $fila["INFORME"])) { ?>

						<!-- Editando título -->

						<h3><input id="FECHAINICIO" name="FECHAINICIO" type="text" value="<?php echo $fila["FECHAINICIO"]; ?>"/>	</h3>

						<h4><?php echo $fila["DURACION"] . " " . $fila["DURACION"]; ?></h4>

				<?php }	else { ?>

						<!-- mostrando título -->

						<input id="FECHACONSULTA" name="FECHACONSULTA" type="hidden" value="<?php echo $fila["FECHACONSULTA"]; ?>"/>

						<div class="fechaInicio"><b><?php echo $fila["FECHACONSULTA"]; ?></b></div>

						<div class="DURACION">By <em><?php echo $fila["MOTIVO"] . " " . $fila["MOTIVO"]; ?></em></div>
                        
                        <BR><div class="COSTE">By <em><?php echo $fila["TRATAMIENTO"] . " " . $fila["TRATAMIENTO"]; ?></em></div>

				<?php } ?>

			</div>

		</form>

	</article>



	<?php } ?>

</main>



  

</body>
</html>