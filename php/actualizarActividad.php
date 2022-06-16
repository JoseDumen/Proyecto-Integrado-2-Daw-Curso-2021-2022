<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $fechaI = explode("/", $datos->fechaI);
        $fechaIBBDD = $fechaI[2]."-".$fechaI[1]."-".$fechaI[0];

        $fechaF = explode("/", $datos->fechaF);
        $fechaFBBDD = $fechaF[2]."-".$fechaF[1]."-".$fechaF[0];


        $sql = "UPDATE actividad SET nombre='$datos->nombre',descripcion='$datos->descripcion',horas='$datos->horas', fechaInicio='$fechaIBBDD', fechaFin='$fechaFBBDD' WHERE id like '$datos->id'";


        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo "ok";
        } else {
            echo "ko";
        }
        
    mysqli_close($conexion);
?>
