<?php
    session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $sql = "SELECT nombre, descripcion FROM tarea WHERE tarcod like '$datos->codigo'";
    
    $resultado = mysqli_query($conexion, $sql);


    $registro = mysqli_fetch_assoc($resultado);

    $valores = $registro["nombre"].",".$registro["descripcion"];


    echo $valores;

    mysqli_close($conexion);
?>