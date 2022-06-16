<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

        $sql = "UPDATE proyecto SET nombre='$datos->nombre',descripcion='$datos->descripcion',datosCLiente='$datos->cliente',importe='$datos->importe', fechaInicio='$datos->fechaI', fechaFin='$datos->fechaF' WHERE idProyecto like '$datos->id'";


        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo "ok";
        } else {
            echo "ko";
        }
        
    mysqli_close($conexion);
?>
