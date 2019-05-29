
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/informe_paciente.css" />
  <title>Informe paciente</title>
  <?php include_once("head.php")?>
</head>

<body>

<?php
	include_once("cabecera_trabajadores.php");

?>

    <main>
	
	    <!-- The HTML login form -->
	    <form action="whoiswho.php" method="post">
		    <div class = "motivo"><label for="motivo">Motivo: </label><input type="text" name="motivo" id="motivo" style="width:25%"/></div>
		    <div class="tratamiento"><label for="tratamiento">Tratamiento: </label><input type="text" name="tratamiento" id="tratamiento" style="width:22%" /></div>
            <input type="submit" class ="butn" name="submit" value="submit" />
	    </form> 
    </main>
<?php
	include_once("pie.php");
?>

</body>
</html>

