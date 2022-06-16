<?php
    session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'), true);

    $id = $datos["idActividad"];

    $sql = "SELECT * FROM actividad WHERE id like '$id'";
    
    $resultado = mysqli_query($conexion, $sql);

    $registro = mysqli_fetch_assoc($resultado);
        $datos = $registro["id"].",".$registro["nombre"].",".$registro["idProyecto"].",".$registro["descripcion"].",".$registro["horas"].",".$registro["fechaInicio"].",".$registro["fechaFin"];


        
    mysqli_close($conexion);

    echo $datos; 

?>