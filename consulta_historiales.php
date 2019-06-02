<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarHistorial.php");
require_once ("paginacion_consulta.php");

if (!isset($_SESSION['login']))
	Header("Location: inicio_sesion.php");
else {
	if (isset($_SESSION["historial"])) {
		$historial = $_SESSION["historial"];
		unset($_SESSION["historial"]);
	}

	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam =3;

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 3;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();

	// La consulta que ha de paginarse
    $query = 'SELECT HISTORIALES.OIDHISTORIAL, HISTORIALES.IDPACIENTE,'
    .'INFORMES.OIDINFORME, INFORMES.FECHACONSULTA, INFORMES.MOTIVOCONSULTA,INFORMES.TRATAMIENTO'
    .'FROM HISTORIALES, INFORMES'
    .'WHERE' . 'HISTORIALES.OIDHISTORIAL = INFORMES.OIDHISTORIAL'
    .'ORDER BY FECHACONSULTA';
    
    
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
    <link rel="stylesheet" type="text/css" href="css/biblio.css" />
	<script type="text/javascript" src="./js/boton.js"></script>
  <?php include_once("head_staff.php"); ?>
  <title>Gestión de veterinaria: lista historiales e informes</title>
</head>

<body>

<?php

include_once ("cabecera_gestor.php");


?>



<main>

	 <nav>

		<div id="enlaces">

			<?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="consulta_historial.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>

		</div>



		<form method="get" action="consulta_historial.php">

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



	<article class="historiales">

		<form method="post" action="controlador_historial.php">

			<div class="fila_historial">

				<div class="datos_historial">

					<input id="OIDHISTORIAL" name="OIDHISTORIAL"

						type="hidden" value="<?php echo $fila["OIDHISTORIAL"]; ?>"/>

					<input id="IDPACIENTE" name="IDPACIENTE"

						type="hidden" value="<?php echo $fila["IDPACIENTE"]; ?>"/>

					<input id="OIDINFORME" name="OIDINFORME"

						type="hidden" value="<?php echo $fila["OIDINFORME"]; ?>"/>

					<input id="FECHACONSULTA" name="FECHACONSULTA"

						type="hidden" value="<?php echo $fila["FECHACONSULTA"]; ?>"/>

					<input id="MOTIVOCONSULTA" name="MOTIVOCONSULTA"

						type="hidden" value="<?php echo $fila["MOTIVOCONSULTA"]; ?>"/>
                    
                    <input id="TRATAMIENTO" name="TRATAMIENTO"

                        type="hidden" value="<?php echo $fila["TRATAMIENTO"]; ?>"/>



				<?php

					if (isset($historial) and ($historial["OIDHISTORIAL"] == $fila["OIDHISTORIAL"])) { ?>

						<!-- Editando título -->

						<h3><input id="MOTIVOCONSULTA" name="MOTIVOCONSULTA" type="text" value="<?php echo $fila["MOTIVOCONSULTA"]; ?>"/>	</h3>

						<h4><?php echo $fila["MOTIVOCONSULTA"] . " " . $fila["TRATAMIENTO"]; ?></h4>

				<?php }	else { ?>

						<!-- mostrando título -->

						<input id="MOTIVOCONSULTA" name="MOTIVOCONSULTA" type="hidden" value="<?php echo $fila["MOTIVOCONSULTA"]; ?>"/>

						<div class="MOTIVOCONSULTA"><b><?php echo $fila["MOTIVOCONSULTA"]; ?></b></div>

						<div class="TRATAMIENTO">By <em><?php echo $fila["TRATAMIENTO"] . " " . $fila["FECHACONSULTA"]; ?></em></div>

				<?php } ?>

				</div>



				<!--<div id="botones_fila">

				<?php if (isset($historial) and ($historial["OIDHISTORIAL"] == $fila["OIDHISTORIAL"])) { ?>

						<button id="grabar" name="grabar" type="submit" class="editar_fila">

							<img src="images/bag_menuito.bmp" class="editar_fila" alt="Guardar modificación">

						</button>

				<?php } else { ?>

						<button id="editar" name="editar" type="submit" class="editar_fila">

							<img src="images/pencil_menuito.bmp" class="editar_fila" alt="Editar historial">

						</button>

				<?php } ?>

					<button id="borrar" name="borrar" type="submit" class="editar_fila">

						<img src="images/remove_menuito.bmp" class="editar_fila" alt="Borrar historial">

					</button>

				</div>-->

			</div>

		</form>

	</article>



	<?php } ?>

</main>



<?php

include_once ("pie.php");
?>

</body>

</html>