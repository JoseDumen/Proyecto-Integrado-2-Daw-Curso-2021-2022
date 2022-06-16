<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    
    $sql = "DELETE FROM actividad WHERE actividad.id = $datos->id";

    $resultado = mysqli_query($conexion,$sql);

    mysqli_close($conexion);
?>
