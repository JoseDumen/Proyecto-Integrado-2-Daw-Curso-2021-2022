<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $fechaI = explode("/", $datos->fecha);
    $fechaIBBDD = $fechaI[2]."-".$fechaI[1]."-".$fechaI[0];

    $sql = "UPDATE partetrabajo SET idActividad='$datos->idActividad',idTarcod='$datos->codigoTarea',fecha='$fechaIBBDD', horas='$datos->horas' WHERE id like '$datos->id'";

    echo $sql;

        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo "ok";
        } else {
            echo "ko";
        }
        
    mysqli_close($conexion);
?>