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
  <link href="https://fonts.googleapis.com/css?family=ABeeZee&display=swap" rel="stylesheet">
	<script type="text/javascript" src="./js/boton.js"></script>
  <title>Citas</title>
  <?php include_once("head.php")?>
</head>

<body>
<?php
	include_once("cabecera.php");
?>
<main>
    <div class = "p">
        <div class = "veterinaria">
            <div class = "logoVeterinaria">
                <div class="circulo" >
                    <div class = "movimientoNaranja">
                        <a title="Consulta" href="form_alta_cliente.php"><img src="images/estetoscopio.png" alt="Consulta" /></a>
                    </div>
                </div>
                <div class = "movimientoTexto1">
                    <br><a href="form_alta_cliente.php">Consulta</a>
                </div>            
            </div>
        </div>
        <div class = "peluqueria">
            <div class = "logoPeluqueria">
                <div class="circulo">
                    <div class = "movimientoNaranja">
                        <a title="Peluquería" href="form_alta_cliente.php"><img src="images/secador-de-pelo.png" alt="Peluquería" /></a>
                    </div>
                </div>
                <div class = "movimientoTexto2">
                    <br><a href="form_alta_cliente.php">Peluquería</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
	include_once("pie.php");
?>
</body>
</html>