<?php
    session_start();

    require_once("gestionBD.php");
    require_once("gestionarTrabajadores.php");
    require_once("paginacion_consulta.php");

    if (!isset($_SESSION['loginGestor']))
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
    $pag_tam = 3 ;

    if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
    if ($pag_tam < 1) 		$pag_tam = 3;

    	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

    $conexion = crearConexionBD();
    
    // La consulta que ha de paginarse
    $query = 'SELECT TRABAJADORES.OIDTRABAJADOR, TRABAJADORES.PASS,TRABAJADORES.FECHANAC,'
    .'TRABAJADORES.NOMBRE, TRABAJADORES.APELLIDOS, TRABAJADORES.DIRECCION,TRABAJADORES.EMAIL,'
    .'TRABAJADORES.HORASTRABAJO,TRABAJADORES.SUELDO,TRABAJADORES.ESGESTOR, TRABAJADORES.DNI, TRABAJADORES.TIPOTRABAJADOR'
    .' FROM TRABAJADORES';

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
	<!-- <script src="js\jquery-3.1.1.min.js"></script> -->
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script language="JavaScript" type="text/javascript">
	$(document).ready(function(){
    	$("a.borrar").click(function(e){
       	 if(!confirm('Are you sure?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>

  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/consulta_trabajadores.css" />
  
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
		<th>Función</th>
    	<th>Horas de trabajo</th>
        <th>Sueldo</th>
        <th>DNI</th>
        <th>Email</th>
        <th>Despedir</th>




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

						            <a class="active" href="consulta_trabajadores.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			                <?php } ?>
                            <a href="#">&raquo;</a>
                 </div>
                 </td>
                </tr>
            </tfoot>



		<form method="get" action="consulta_trabajadores.php">

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



	<article class="trabajador">

		<form id="form1" name="form1" method="get" action="controlador_trabajadores.php">

			<div class="fila_trabajador">

				<div class="datos_trabajador">

					<input id="OIDTRABAJADOR" name="OIDTRABAJADOR"

						type="hidden" value="<?php echo $fila["OIDTRABAJADOR"]; ?>"/>

					<input id="PASS" name="PASS"

						type="hidden" value="<?php echo $fila["PASS"]; ?>"/>

					<input id="FECHANAC" name="FECHANAC"

						type="hidden" value="<?php echo $fila["FECHANAC"]; ?>"/>

					<input id="NOMBRE" name="NOMBRE"

						type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>

                    <input id="APELLIDOS" name="APELLIDOS"

                        type="hidden" value="<?php echo $fila["APELLIDOS"]; ?>"/>
                    
                    <input id="DIRECCION" name="DIRECCION"

                                type="hidden" value="<?php echo $fila["DIRECCION"]; ?>"/>
                    <input id="EMAIL" name="EMAIL"

                                type="hidden" value="<?php echo $fila["EMAIL"]; ?>"/>
                    
                    <input id="HORASTRABAJO" name="HORASTRABAJO"

                                type="hidden" value="<?php echo $fila["HORASTRABAJO"]; ?>"/>

                    <input id="SUELDO" name="SUELDO"

                                type="hidden" value="<?php echo $fila["SUELDO"]; ?>"/>

                    <input id="ESGESTOR" name="ESGESTOR"

                                type="hidden" value="<?php echo $fila["ESGESTOR"]; ?>"/>

                    <input id="DNI" name="DNI"

                                type="hidden" value="<?php echo $fila["DNI"]; ?>"/>
								
					<input id="TIPOTRABAJADOR" name="TIPOTRABAJADOR"

								type="hidden" value="<?php echo $fila["TIPOTRABAJADOR"]; ?>"/>



				

						<!-- mostrando título -->

						  
						<input id="OIDTRABAJADOR" name="OIDTRABAJADOR" type="hidden" value="<?php echo $fila["OIDTRABAJADOR"]; ?>"/>
                        <tbody>
                        <tr>
	
                            <td><?php echo $fila["OIDTRABAJADOR"]; ?></td>
							<td><?php echo $fila["NOMBRE"]; ?></td>
							<td><?php echo $fila["APELLIDOS"]; ?></td>
							<td><?php echo $fila["TIPOTRABAJADOR"]; ?></td>
							<td><?php echo $fila["HORASTRABAJO"]; ?></td>
                            <td><?php echo $fila["SUELDO"]; ?></td>
                            <td><?php echo $fila["DNI"]; ?></td>
                            <td><?php echo $fila["EMAIL"]; ?></td>
							
							
                            <td>
								<a id="borrar" name="borrar" class="borrar"
								 href="accion_borrar_trabajador.php" >Borrar</a>
								 <!-- onclick="return confirm('¿Estás seguro?')" -->
								<!-- <input id="borrar" name="borrar" onClick="" type="submit"> -->
                                <!-- <button id="borrar" name="borrar" type=submit class="editar_fila" onclick="pregunta()" value="exy">
                                    <img src="images/borrar.png" class="editar_fila" alt="Borrar">
                                </button>  -->
                            </td>

                        </tr>
                        </tbody>
				</div>		
				

				

			</div>

		</form>

	</article>



	<?php } ?>
        </table>
        
        <div class="botoncillo1">    
            <a href="form_alta_trabajador.php"><input type="button" class="butn" value="Contratar"></a>
        </div>

</main>


<?php
	include_once("pie.php");
?>



  

</body>


<script type="text/javascript">

document.getElementById("form1").onsubmit = function onSubmit(form) {
   singleAmount = document.getElementById("form1").value;
   if (confirm("Are you sure you want to submit the value of " + form1 + " ?"))
      return true;
   else
     return false;
</script>

</html>

