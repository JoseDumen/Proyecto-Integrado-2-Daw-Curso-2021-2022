<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $id = $datos->idEmpleado;

    $sql = "SELECT estado FROM empleados WHERE id like '$id'";

    $resultado = mysqli_query($conexion,$sql);
    $estadoEmpleado = mysqli_fetch_assoc($resultado);

    if ($estadoEmpleado['estado'] == '1') {
        $sql = "UPDATE empleados SET estado='0' WHERE id like '$id'";
        $estadoNuevo = "D";

    } else {
        $sql = "UPDATE empleados SET estado='1' WHERE id like '$id'";
        $estadoNuevo = "C";
    }

    $resultado = mysqli_query($conexion,$sql);

    if($resultado){
        echo $estadoNuevo;
    }

    mysqli_close($conexion);
?>
