<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Hay que indicar el fichero externo de estilos -->
  <link rel="stylesheet" type="text/css" href="css/citas.css" />
  <script type="text/javascript" src="./js/boton.js"></script>
  <title>Citas</title>
  <?php include_once("head_staff.php")?>
</head>

<body>
<?php
	include_once("cabecera_gestor.php");
?>
<main>

    <div class = "p">
        <div class = "veterinaria">
            <div class = "logoVeterinaria">
                <div class="circulo" >
                    <div class = "movimientoNaranja">
                        <a title="Cita" href="form_alta_cliente.php"><img src="images/fecha_cita.png" alt="Cita" /></a>
                    </div>
                </div>
                <div class = "movimientoTexto3">
                    <br><a href="form_alta_cliente.php">Cita</a>
                </div>            
            </div>
        </div>
        <div class = "peluqueria">
            <div class = "logoPeluqueria">
                <div class="circulo">
                    <div class = "movimientoNaranja">
                        <a title="Empleados" href="form_alta_cliente.php"><img src="images/empleado.png" alt="Empleados" /></a>
                    </div>
                </div>
                <div class = "movimientoTexto5">
                    <br><a href="form_alta_cliente.php">Empleados</a>
                </div>
            </div>
        </div>
    </div>
    <?php
	include_once("pie.php");
?>
</main>

</body>
</html>