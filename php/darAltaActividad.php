<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $fechaI = $datos->fechaI;
    $fechaIpartida = explode("/", $fechaI);
    $fechaIBBDD = $fechaIpartida[2]."-".$fechaIpartida[1]."-".$fechaIpartida[0];

    $fechaF = $datos->fechaF;
    $fechaFpartida = explode("/", $fechaF);
    $fechaFBBDD = $fechaFpartida[2]."-".$fechaFpartida[1]."-".$fechaFpartida[0];

    $sql = "INSERT INTO actividad (nombre, idProyecto, descripcion, horas, fechaInicio, fechaFin) VALUES ('$datos->nombre', '$datos->id', '$datos->descripcion', '$datos->horas', '$fechaIBBDD', '$fechaFBBDD')";

        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo "ok";
        } else {
            echo "ko";
        }

    mysqli_close($conexion);
?>
