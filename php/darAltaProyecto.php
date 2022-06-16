<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    
    $sql = "INSERT INTO proyecto (nombre, descripcion, datosCliente, importe, fechaInicio, fechaFin) VALUES ('$datos->nombre', '$datos->descripcion', '$datos->cliente', '$datos->importe', '$datos->fechaI', '$datos->fechaF')";

        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo "ok";
        } else {
            echo "ko";
        }

    mysqli_close($conexion);
?>
