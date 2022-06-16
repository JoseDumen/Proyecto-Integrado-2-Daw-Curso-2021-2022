<?php
    session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $sql = "SELECT * FROM actividad WHERE idProyecto like '$datos->id'";
    
    $resultado = mysqli_query($conexion, $sql);

    $tabla="";

    while ($registro = mysqli_fetch_assoc($resultado)) {
        $id = $registro["id"];
        $nombre = $registro["nombre"];
        $descripcion = $registro["descripcion"];
        $horas = $registro["horas"];
        
        $fechaInicio = $registro["fechaInicio"];
        $fechaInicioPartida = explode("-",$fechaInicio);
        $fechaInicioFormateada = $fechaInicioPartida[2]."/".$fechaInicioPartida[1]."/".$fechaInicioPartida[0];
        
        $fechaFin = $registro["fechaFin"];
        $fechaFinPartida = explode("-",$fechaFin);
        $fechaFinFormateada = $fechaFinPartida[2]."/".$fechaFinPartida[1]."/".$fechaFinPartida[0];





        $tabla.= "<tr>
        <td>$nombre</td>
        <td>$descripcion</td>
        <td>$horas</td>
        <td>$fechaInicioFormateada</td>
        <td>$fechaFinFormateada</td>
        <td><input type='button' onclick='añadirTarea($id)' class='btn btn-outline-info' value='Añadir' </td>
        <td><input type='button' onclick='modificar($id)' class='btn btn-outline-secondary' value='Modificar' </td>
        <td><input type='button' onclick='eliminar($id)' class='btn btn-outline-danger' value='Eliminar' </td>
        </tr>";
            
        
    }

    echo $tabla;

    mysqli_close($conexion);
?>