<?php
    session_start();

    require_once ("gestionBD.php");
    require_once ("gestionarPacientes.php");

    function consultarPacientesPorCliente($conexion,$dni) {
        $consulta = "SELECT * FROM Pacientes WHERE DNI=:dni";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':dni',$dni);
        
        $stmt->execute();
        return $stmt->fetch();
        }

    
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

    <div>
        <!--<table>
            <thead>
            <tr>
                <td>ID Paciente</td>
                <td>Fecha de nacimiento</td>
                <td>Color de pelo</td>
                <td>Raza</td>
                <td>Especie</td>
                <td>DNI</td>

            </tr>
            </thead>


        </table>-->


    </div>



    <?php
	include_once("pie.php");
    ?>


</body>
</html>