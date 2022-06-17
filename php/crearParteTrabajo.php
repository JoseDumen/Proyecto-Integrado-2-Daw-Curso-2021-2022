<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $idActividad = $datos->id;
    $idTarcod = $datos->codigo;
    $idEmpleado = $_SESSION["id"];
    $fecha = $datos->fecha;
    $horas = $datos->horas;

    $fechaPartida = explode("/", $fecha);
    $fechaBBDD = $fechaPartida[2]."-".$fechaPartida[1]."-".$fechaPartida[0];


    $sql = "INSERT INTO partetrabajo (idActividad, idTarcod, idEmpleado, fecha, horas) VALUES ('$idActividad', '$idTarcod', '$idEmpleado', '$fechaBBDD', '$horas')";

    echo $sql;


        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo "ok";
        } else {
            echo "ko";
        }

    mysqli_close($conexion);
?>
