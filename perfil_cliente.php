<?php
    session_start();

  /*  require_once("gestionBD.php");
    require_once("gestionarCitas.php");
    require_once("paginacion_consulta.php");

    if (!isset($_SESSION['login']))
	Header("Location: inicio_sesion.php");
    else {
	    if (isset($_SESSION["cita"])) {
		    $libro = $_SESSION["cita"];
		    unset($_SESSION["cita"]);
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
    $query = 'SELECT CITAS.OIDCITA, CITAS.DNI, CITAS.OIDGESTOR,CITAS.FECHAINICIO,'
    . 'CITAS.FECHAFIN, CITAS.DURACIONMIN,CITAS.COSTE'
    .'FROM CITAS'
    .'WHERE' . 'CITAS.DNI = CLIENTE.DNI'
    .'ORDER BY FECHAINICIO';
    
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
}*/
    
?>




<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/perfil_usuario.css" />

  <title>Perfil</title>

  <?php include_once("head.php")?>
</head>

<body>
    <?php
	    include_once("cabecera.php");
    ?>



    


    <div class="todo">

    

        <div class="perfil">

            <a href="perfil_personal_cliente.php"><img src="images/perfil_logo.png"  /></a>
            <br><a href="perfil_personal_cliente.php">Información personal</a>
        </div>

        <div class="mascota">

            <a  href="perfil_mascota.php"><img src="images/mascota_logo.png" /></a>
            <br><a href="perfil_mascota.php">Mi mascota</a>
        
        </div>

        <div class="tabla">
        


    </div>



    <?php
	include_once("pie.php");
    ?>


</body>
</html>