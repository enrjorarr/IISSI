<?php
	session_start();
  	
  	include_once("gestionBD.php");
    include_once("gestionarClientes.php");
    include_once("gestionarTrabajadores.php");
	
	if (isset($_POST['submit'])){
		$email= $_POST['email'];
		$pass = $_POST['pass'];
		$num_usuarios = 0;
		$conexion = crearConexionBD();

		if(existeCliente($conexion,$email,$pass)){

				
			$_SESSION['login'] = $email;
			Header("Location: inicio.php");
			cerrarConexionBD($conexion);
			
    }elseif(existeTrabajador($conexion,$email,$pass)){

			$miscojones = consultarTrabajador2email($conexion,$email);
			$vergota = $miscojones["ESGESTOR"];

				if($vergota == "s"){
					$_SESSION['loginGestor'] = $email;
					Header("Location: inicio_gestor.php");
				}else{
					$_SESSION['loginTrabajador'] = $email;
					Header("Location: inicio_trabajador.php");
				}

			cerrarConexionBD($conexion);	
	
			
        }	
	else{
      if ($num_usuarios == 0)
        $login = "error";	
    	else {
        $_SESSION['login'] = $email;
				Header("Location: inicio_sesion.php");
			}
		}
    }

?>
