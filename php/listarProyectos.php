<?php
    session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $sql = "SELECT * FROM proyecto ORDER BY fechaInicio ASC";
    
    $resultado = mysqli_query($conexion, $sql);

    $tabla = "<table id='tablaProyectos' name='tablaProyectos' class='table table-striped' style='width:100%'><thead>";
    $tabla.= "<tr><th>Nombre</th><th>Descripción</th><th>Datos cliente</th><th>Importe</th><th>Fecha inicio</th><th>Fecha fin</th><th>Información</th></tr>";
    $tabla.= "</thead><tbody>";

    while ($registro = mysqli_fetch_assoc($resultado)) {
        $id = $registro["idProyecto"];
        $nombre = $registro["nombre"];
        $descripcion = $registro["descripcion"];
        $datosCliente = $registro["datosCliente"];
        $importe = str_replace(".",",",$registro["importe"]);
        
        $fechaInicio = $registro["fechaInicio"];
        $fechaInicioPartida = explode("-",$fechaInicio);
        $fechaInicioFormateada = $fechaInicioPartida[2]."/".$fechaInicioPartida[1]."/".$fechaInicioPartida[0];
    
        $fechaFin = $registro["fechaFin"];
        $fechaFinPartida = explode("-",$fechaFin);
        $fechaFinFormateada = $fechaFinPartida[2]."/".$fechaFinPartida[1]."/".$fechaFinPartida[0];

        $tabla .= "<tr>";
        $tabla .= "<td>$nombre</td>";
        $tabla .= "<td>$descripcion</td>";
        $tabla .= "<td>$datosCliente</td>";
        $tabla .= "<td>$importe</td>";
        $tabla .= "<td>$fechaInicioFormateada</td>";
        $tabla .= "<td>$fechaFinFormateada</td>";
        $tabla .= "<td><input type='button' onclick='ver($id)' class='btn btn-outline-info' value='Ver' ></td></td>";

        
        $tabla .= "</tr>";
    }

    $tabla.= "<tbody></table>";

    echo $tabla;



    mysqli_close($conexion);
?>