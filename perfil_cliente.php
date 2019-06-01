<?php
    session_start();


    
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

            <a href="informacion_personal.php"><img src="images/perfil_logo.png"  /></a>
            <br><a href="informacion_personal.php">Información personal</a>
        </div>

        <div class="mascota">

            <a  href="informacion_mascotas.php"><img src="images/mascota_logo.png" /></a>
            <br><a href="informacion_mascotas.php">Mi mascota</a>
        
       
        


    </div>




    <?php
	include_once("pie.php");
    ?>


</body>
</html>