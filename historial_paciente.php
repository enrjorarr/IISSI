<?php
	session_start();

	require_once ("gestionBD.php");
    require_once ("gestionarInformes.php"); 
    require_once ("paginacion_consulta.php");

	if (!isset($_SESSION['loginTrabajador']))
	Header("Location: inicio_sesion.php");
    else {
	    if (isset($_SESSION["informe"])) {
		    $informe = $_SESSION["informe"];
		    unset($_SESSION["informe"]);
	    }
    }
    if (isset($_POST['submit'])){
		$id= $_POST['id'];
		$conexion = crearConexionBD();
        $paciente = consultarPacientes2ID($conexion,$id);
		cerrarConexionBD($conexion);	
        
		if ($paciente == null)
			$login = "error";	
		else {
        
			$_SESSION['paciente'] = $paciente;
			Header("Location: historial_paciente.php");
		}	
    }
    
    //P A G I N A C I O N 

    if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = 3;

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 5;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

    $conexion = crearConexionBD();
    
    if(isset($_POST['id'])){

        $paciente=$_POST['id'];
    // La consulta que ha de paginarse
        $query = 'SELECT INFORMES.OIDINFORME, INFORMES.FECHACONSULTA, INFORMES.TRATAMIENTO, INFORMES.OIDHISTORIAL, '
        .' HISTORIALES.IDPACIENTE '
        .' FROM INFORMES LEFT OUTER JOIN HISTORIALES ON INFORMES.OIDHISTORIAL=HISTORIALES.OIDHISTORIAL '
        .' WHERE '.' INFORMES.OIDHISTORIAL IN (SELECT HISTORIALES.OIDHISTORIAL FROM HISTORIALES WHERE IDPACIENTE= :paciente)';
    } else {
    
        $query = 'SELECT INFORMES.OIDINFORME, INFORMES.FECHACONSULTA, INFORMES.TRATAMIENTO, INFORMES.OIDHISTORIAL, '
        .' HISTORIALES.IDPACIENTE '
        .' FROM INFORMES LEFT OUTER JOIN HISTORIALES ON INFORMES.OIDHISTORIAL=HISTORIALES.OIDHISTORIAL';
    }


    
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
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
  <link rel="stylesheet" type="text/css" href="css/historial_paciente.css" />
  <script type="text/javascript" src="./js/boton.js"></script>
  <title>Historial pacientes</title>
  <?php include_once("head_staff.php")?>
</head>


<body>
<div class="wrapper">
<?php
	include_once("cabecera_trabajadores.php");
?>
<main>

    <div class = "p">
        <div class="busqueda">
            <form action="historial_paciente.php" method="post">
                <div class = "id">
                    <label for="id">Busqueda por id del paciente: </label>
                    <input type="text" name="id" id="id" pattern="^[0-9]{9}" />
                    <input type="submit" class ="butn" name="buscar" value="buscar" />
                </div>
            </form>
        </div>

       
            
       

        <div class="informe">
            <form action="form_alta_informe.php">
                <input type="submit" class ="butn" name="informe" value="Añadir informe" />
            </form>            
        </div>
        <div class="historial">
            <form action="form_alta_historial.php">
                <input type="submit" class ="butn" name="historial" value="Añadir historial"/>
            </form>  
        </div>
    </div>

    <!-- LO DE LA TABLA-->
    <div class="tabla">
    <table class="consulta">
            <thead>
            <tr>
                <th>ID Paciente</th>
                <th>OID INFORME</th>
                <th>Fecha de consulta</th>

                <th>Tratamiento</th>
                <th>OIDHistorial</th>

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

						            <a class="active" href="historial_paciente.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			                <?php } ?>
                            <a href="#">&raquo;</a>
                 </div>
                 </td>
                </tr>
            </tfoot>

    

        

		<form method="get" action="historial_paciente.php">

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
    
            
    
       
	<article class="informe">

		<form method="get" action="controlador_informe.php">

			<div class="fila_informe">

				<div class="datos_informe">

                    <input id="IDPACIENTE" name="IDPACIENTE"

                    type="hidden" value="<?php echo $fila["IDPACIENTE"]; ?>"/>

					<input id="OIDINFORME" name="OIDINFORME"

						type="hidden" value="<?php echo $fila["OIDINFORME"]; ?>"/>

					<input id="FECHACONSULTA" name="FECHACONSULTA"

						type="hidden" value="<?php echo $fila["FECHACONSULTA"]; ?>"/>

					<input id="TRATAMIENTO" name="TRATAMIENTO"

                        type="hidden" value="<?php echo $fila["TRATAMIENTO"]; ?>"/>
                    


					<input id="OIDHISTORIAL" name="OIDHISTORIAL"

						type="hidden" value="<?php echo $fila["OIDHISTORIAL"]; ?>"/>


						<!-- mostrando título -->
                        
						<input id="IDPACIENTE" name="IDPACIENTE" type="hidden" value="<?php echo $fila["IDPACIENTE"]; ?>"/>
                        <tbody>
                        <tr>
                            <td><?php echo $fila["IDPACIENTE"]; ?></td>
                            <td><?php echo $fila["OIDINFORME"]; ?></td>
                            <td><?php echo $fila["FECHACONSULTA"]; ?></td>
                            <td><?php echo $fila["TRATAMIENTO"]; ?></td>
                            
                            <td> <?php echo $fila["OIDHISTORIAL"]; ?></td>
                        </tr>
                        </tbody>
                    
            </div>



				
			</div>

		</form>

    </article>
  
    
    



    <?php } ?>
        
    </table>
    </div>
    
</main>

<div class="push"></div>
       </div>
       <div class="footer">
            <?php
	            include_once("pie.php");
            ?>
       </div>


</body>
</html>

<?php
	cerrarConexionBD($conexion);
?>