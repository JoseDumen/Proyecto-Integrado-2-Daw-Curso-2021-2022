<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    
    $sql = "INSERT INTO tarea (tarcod, nombre, descripcion) VALUES ('$datos->codigo', '$datos->nombre', '$datos->descripcion')";

        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo "ok";
        } else {
            echo "ko";
        }

    mysqli_close($conexion);
?>
