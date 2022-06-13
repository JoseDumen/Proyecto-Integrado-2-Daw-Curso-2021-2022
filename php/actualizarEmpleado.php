<?php
session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $id = $_SESSION["id"];

        $sql = "UPDATE empleados SET nombre='$datos->nombre',telefono='$datos->telefono',correo='$datos->correo',contraseña='$datos->pass' WHERE id like '$id'";


        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo "ok";
        } else {
            echo "ko";
        }
        
    mysqli_close($conexion);
?>
