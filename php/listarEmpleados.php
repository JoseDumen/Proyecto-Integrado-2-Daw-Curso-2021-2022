<?php
    session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $sql = "SELECT * FROM empleados ORDER BY estado DESC";
    
    $resultado = mysqli_query($conexion, $sql);

    $tabla = "<table id='tablaEmpleados' name='tablaEmpleados' class='table table-striped' style='width:100%'><thead>";
    $tabla.= "<tr><th>Nombre</th><th>Teléfono</th><th>Correo</th><th>Categoría</th><th>Informes</th><th>Estado</th></tr>";
    $tabla.= "</thead><tbody>";

    while ($registro = mysqli_fetch_assoc($resultado)) {
        $id= $registro['id'];
        $nombre = $registro['nombre'];
        $telefono = $registro['telefono'];
        $correo = $registro['correo'];
        $tabla .= "<tr>";
        $tabla .= "<td>$nombre</td>";
        $tabla .= "<td>$telefono</td>";
        $tabla .= "<td>$correo</td>";
        
        switch ($registro['categoria']) {
            case 'jefe':
                $tabla .= "<td>Jefe de Proyecto</td>";
                break;
            case 'analista':
                $tabla .= "<td>Analista</td>";
                break;
            case 'programador':
                $tabla .= "<td>Programador</td>";
                break;
            
        }
        
        $tabla .= "<td><input type='button' onclick='verInformes($id)' class='btn btn-outline-info' value='Informes'></td>";

        if($registro['estado'] == '1'){
            if($_SESSION["id"] == $id){
                $tabla .= "<td><input type='button' onclick='cambiarEstado($id)' class='btn btn-outline-danger' value='Despedir' disabled><span style='display:none'>Activo</span></td>";
            } else {
                $tabla .= "<td><input type='button' onclick='cambiarEstado($id)' class='btn btn-outline-danger' value='Despedir'><span style='display:none'>Activo</span></td>";
            }
            
        } else {
            $tabla .= "<td><input type='button' onclick='cambiarEstado($id)' class='btn btn-outline-success' value='Contratar'><span style='display:none'>Despedido</span></td>";

        }


        
        $tabla .= "</tr>";
    }

    $tabla.= "<tbody></table>";

    echo $tabla;



    mysqli_close($conexion);
?>