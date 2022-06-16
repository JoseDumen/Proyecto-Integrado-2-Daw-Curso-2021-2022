<?php
    session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $sql = "SELECT * FROM tarea";
    
    $resultado = mysqli_query($conexion, $sql);

    $tabla="";

    while ($registro = mysqli_fetch_assoc($resultado)) {
        $codigo = $registro["tarcod"];
        $nombre = $registro["nombre"];
        $descripcion = $registro["descripcion"];
        $tabla.= "<tr>
        <td>$codigo</td>
        <td>$nombre</td>
        <td>$descripcion</td>
        <td><input type='button' onclick='modificar($codigo)' class='btn btn-outline-secondary' value='Modificar' </td>
        <td><input type='button' onclick='eliminar()' class='btn btn-outline-danger' value='Eliminar' </td>
        </tr>";
            
        
    }

    echo $tabla;

    mysqli_close($conexion);
?>