<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $sql = "SELECT * FROM empleados WHERE correo like '$datos->correo'";
    //$sql = "SELECT * FROM empleados WHERE correo like 'dani@gmail.com' AND contraseña like 'dani1234'";

    
    $resultado = mysqli_query($conexion, $sql);
    $registro = mysqli_fetch_assoc($resultado);

    /*
    echo "<pre>";
    print_r($registro);
    echo "</pre>";
    */

    if($registro){
        echo "existe";
    } else {
        $sql = "INSERT INTO empleados (nombre, telefono, correo, contraseña, categoria, estado) VALUES ('$datos->nombre', '$datos->telefono', '$datos->correo', '$datos->pass', '$datos->categoria', '1')";

        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo "ok";
        } else {
            echo "ko";
        }
    }

    mysqli_close($conexion);
?>
