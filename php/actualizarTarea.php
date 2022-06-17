<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

        $sql = "UPDATE tarea SET tarcod='$datos->codigo',nombre='$datos->nombre' WHERE tarcod like '$datos->codigo'";

        echo $sql;


        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo "ok";
        } else {
            echo "ko";
        }
        
    mysqli_close($conexion);
?>
