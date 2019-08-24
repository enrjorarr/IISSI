<?php
    session_start();

    require_once("gestionBD.php");
    require_once("gestionarPetCitas.php");
    require_once("paginacion_consulta.php");

    if (!isset($_SESSION['loginGestor']))
		Header("Location: inicio_sesion.php");
    else {
	    if (isset($_SESSION["petcita"])) {
		    $petcita = $_SESSION["petcita"];
		    unset($_SESSION["petcita"]);
        }


 
        
    	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"]))
    $paginacion = $_SESSION["paginacion"];

    $pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
    $pag_tam =1;

    if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
    if ($pag_tam < 1) 		$pag_tam = 1;

    	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

    $conexion = crearConexionBD();
    
    // La consulta que ha de paginarse
    $query = 'SELECT PETICIONCITAS.OIDPETCITA, PETICIONCITAS.DNI, PETICIONCITAS.MOTIVO,PETICIONCITAS.FECHAINICIO, '
	. 'PETICIONCITAS.IDPACIENTE, PETICIONCITAS.TIPOCITA '
    .' FROM PETICIONCITAS '
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
  <link rel="stylesheet" type="text/css" href="css/consulta_petcitas.css" />
  
  <title>consulta citas</title>
	<?php include_once("head_staff.php"); ?>

		<!--include jQuery -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"
		type="text/javascript"></script>
 
	<!--include jQuery Validation Plugin-->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"
		type="text/javascript"></script>
 
	<!--Optional: include only if you are using the extra rules in additional-methods.js -->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js"
		type="text/javascript"></script>
  
	<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>

<script language="JavaScript" type="text/javascript">
  $(document).ready(function(){
	  $("a.borrar").click(function(e){
		  if(!confirm('¿Estás seguro de que quieres borrar el paciente?')){
		  e.preventDefault();
		  return false;
	  }
	  return true;
  });
});
</script>
</head>

<body>
    <?php
	    include_once("cabecera_gestor.php");
    ?>
	

    <main>





 <table class="consulta">

     <thead>
    <tr>
    	<th>Petición</th>
    	<th>DNI</th>
    	<th>Fecha</th>
        <th>ID Paciente</th>
		<th>Tipo Cita</th>
		<th>Rechazar</th>
        <th>Aceptar</th>


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

						            <a class="active" href="consulta_petcitas.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			                <?php } ?>
                            <a href="#">&raquo;</a>
                 </div>
                 </td>
                </tr>
            </tfoot>



		<form method="get" action="consulta_petcitas.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="1"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form>

	



	<?php

		foreach($filas as $fila) {

	?>



	<article class="petcita">

		<form method="get" id="consultaPetCita"action="controlador_petcitas.php">

			<div class="fila_petcita">

				<div class="datos_petcita">

					<input id="OIDPETCITA" name="OIDPETCITA"

						type="hidden" value="<?php echo $fila["OIDPETCITA"]; ?>"/>

					<input id="DNI" name="DNI"

						type="hidden" value="<?php echo $fila["DNI"]; ?>"/>

					<input id="MOTIVO" name="MOTIVO"

						type="hidden" value="<?php echo $fila["MOTIVO"]; ?>"/>

					<input id="FECHAINICIO" name="FECHAINICIO"

						type="hidden" value="<?php echo $fila["FECHAINICIO"]; ?>"/>

					<input id="IDPACIENTE" name="IDPACIENTE"

						type="hidden" value="<?php echo $fila["IDPACIENTE"]; ?>"/>

					<input id="TIPOCITA" name="TIPOCITA"

						type="hidden" value="<?php echo $fila["TIPOCITA"]; ?>"/>




				

						<!-- mostrando título -->

						
						<input id="OIDPETCITA" name="OIDPETCITA" type="hidden" value="<?php echo $fila["OIDPETCITA"]; ?>"/>
                        <tbody>
                        <tr>
                            <td><?php echo $fila["OIDPETCITA"]; ?></td>
                            <td><?php echo $fila["DNI"]; ?></td>
                            <td><?php echo $fila["FECHAINICIO"]; ?></td>
                            <td><?php echo $fila["IDPACIENTE"]; ?></td>
							<td><?php echo $fila["TIPOCITA"]; ?></td>
                            <td>
							<a id="borrar" name="borrar" class="borrar"
								 href="accion_eliminar_cita.php" ><input type=submit id="borrar" 
								 name="borrar" value="Borrar">
							</a>
                            </td>
                            <td>
                                <button id="aceptar" name="aceptar" type="submit" class="editar_fila">
                                    <img src="images/aceptar.jpg" class="editar_fila" alt="Aceptar">
                                </button>
                            </td>
                        </tr>
                        </tbody>
				</div>		
				

				

			</div>
				Coste               :<input type="number" id = "Coste" name="Coste" > <br/>
			    Hora de inicio      :<input type="text" id = "HoraInicio" name="HoraInicio" ><br/>
				Duracion en minutos :  <input type= "number" id = "DuracionMin"  name = "DuracionMin"><br/>
				OID Trabajador: <input type= "number" id = "OIDTrabajador"  name = "OIDTrabajador">
		</form>

    </article>
    



	<?php } ?>
        </table>

        <div class="botoncillo1">    
            <a href="consulta_citas_gestor.php"><input type="button" class="butn" value="Atrás"></a>
        </div>
 </main>


<?php
	include_once("pie.php");
?>



  

</body>

<script type = "text/javascript">

		$(function(){

			$("#consultaPetCita").validate(
				{
					rules:{
						Coste:{
							required:true,
							min:0	
						},
						HoraInicio:{
							 required:true
						 },
						 
						 DuracionMin:{
							required:true,
							min:15,
							max:59
						},
						
						OIDTrabajador:{
							required:true,
							maxlength:2,
							minlength:1
						}
					},
					messages:{
						Coste:{
							required:"Este campo debe estar completo",
							min:"No se admiten precios negativos"	
						},

						HoraInicio:{
							 required:"Este campo debe estar completo"
						 },

						DuracionMin:{
							required:"Debe contener un número",
							min:"La duración minima es de 15 minutos",
							max:"La duración maxima es de 59 minutos"
						},
						OIDTrabajador:{
							required:"Esta casilla debe estar completada",
							maxlength:"El número debe estar compuesto de 1 a 2 dígitos",
							minlength:"El número debe estar compuesto de 1 a 2 dígitos"

						}
						
						
				
					}
			

				});	

			});

	
	
	</script>

	</html>
        
