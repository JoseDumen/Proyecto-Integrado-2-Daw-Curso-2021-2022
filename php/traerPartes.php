<?php
    session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $sql = "SELECT * FROM partetrabajo";
    
    $resultado = mysqli_query($conexion, $sql);

    $tabla="";

    while ($registro = mysqli_fetch_assoc($resultado)) {
        $idParte = $registro["id"];

        $idActividad = $registro["idActividad"];
        $idTarcod = $registro["idTarcod"];
        
        $fecha = $registro["fecha"];
        $fechaPartida = explode("-",$fecha);
        $fechaNueva = $fechaPartida[2]."/".$fechaPartida[1]."/".$fechaPartida[0];

        $horas = $registro["horas"];

        $sqlAux = "SELECT nombre FROM actividad WHERE id like '$idActividad'";
        $resultadoAux = mysqli_query($conexion, $sqlAux);
        $fila = mysqli_fetch_assoc($resultadoAux);

        $nombreActividad = $fila["nombre"];
        
        $sqlAux2 = "SELECT * FROM tarea WHERE tarcod like '$idTarcod'";
        $resultadoAux2 = mysqli_query($conexion, $sqlAux2);
        $datosTarea = mysqli_fetch_assoc($resultadoAux2);

        $nombreTarea = $datosTarea["nombre"];
        $descripcionTarea = $datosTarea["descripcion"];

        $tabla.="<tr>
        <td>$nombreActividad</td>
        <input type='hidden' value='$idActividad'>
        <input type='hidden' value='$idParte'>
        <td>$idTarcod</td>
        <td>$nombreTarea</td>
        <td>$descripcionTarea</td>
        <td>$fechaNueva</td>
        <td>$horas</td>
        <td><input type='button' onclick='modificar($idParte)' class='btn btn-outline-secondary' value='Modificar' </td>
        <td><input type='button' onclick='eliminar($idParte)' class='btn btn-outline-danger' value='Eliminar' </td>
        
        </tr>";









            
        
    }

    echo $tabla;

    mysqli_close($conexion);
?>