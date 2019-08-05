<?php
    session_start();
    


 //   if (!isset($_SESSION['login']))
	//Header("Location: inicio_sesion.php");


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
  <?php include_once("head.php")?>
</head>

<body>
<?php
	include_once("cabecera.php");
?>
<main>
   <?php if (isset($_SESSION['login'])){?>
  
    <div class = "p">
        <div class = "veterinaria">
            <div class = "logoVeterinaria">
                <div class="circulo" >
                    <div class = "movimientoNaranja">
                    <form action = "form_alta_petCita.php" method = "POST" name="formulario">
                      
                        <input type="image" src="images/estetoscopio.png"/>
                        <input type="hidden" id="code" name="code" value="c">
                    </form>
                    </div>
                </div>
                <div class = "movimientoTexto1">
                    <br><a href="form_alta_petCita.php">Consulta</a>
                </div>            
            </div>
        </div>
        <div class = "peluqueria">
            <div class = "logoPeluqueria">
                <div class="circulo">
                    <div class = "movimientoNaranja">

                    <form action = "form_alta_petCita.php" method = "POST" name="formulario">
                        <input type="image" src="images/secador-de-pelo.png"/>
                        <input type="hidden" id="code" name="code" value="p">
                    </form>
                                            
                    </div>
                </div>
                <div class = "movimientoTexto2">
                    <br><a href="form_alta_petCita.php">Peluquería</a>
                </div>
            </div>
        </div>
    </div>
   <?php }else{ ?>     
       <div class = "veterinaria">
            <div class = "logoVeterinaria">
                <div class="circulo" >
                    <div class = "movimientoNaranja">
                        <a title="Consulta" href="inicio_sesion.php"><img src="images/estetoscopio.png" alt="Consulta" /></a>
                    </div>
                </div>
                <div class = "movimientoTexto1">
                    <br><a href="inicio_sesion.php">Consulta</a>
                </div>            
              </div>
            </div>
            <div class = "peluqueria">
            <div class = "logoPeluqueria">
                <div class="circulo">
                    <div class = "movimientoNaranja">
                        <a title="Peluquería" href="inicio_sesion.php"><img src="images/secador-de-pelo.png" alt="Peluquería" /></a>
                    </div>
                </div>
                <div class = "movimientoTexto2">
                    <br><a href="inicio_sesion.php">Peluquería</a>
                </div>
            </div>
        </div>
    </div>
   <?php } ?>    
    <?php
	include_once("pie.php");
?>
</main>

</body>
</html>