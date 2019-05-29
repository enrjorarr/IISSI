<?php 
   
    try{
        require_once("gestionBD.php");
        $conexion = crearConexionBD();
        var_dump($conexion);
        cerrarConexionBD($conexion);
        

    }catch(PDOException $e){

        var_dump($e->GetMessage());

    }
?>