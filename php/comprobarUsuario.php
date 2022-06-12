<?php
    session_start();

    include "../conexion/conexion.php";

    $datos = json_decode(file_get_contents('php://input'));

    $sql = "SELECT * FROM empleados WHERE correo like '$datos->correo' AND contraseña like '$datos->password'";
    //$sql = "SELECT * FROM empleados WHERE correo like 'dani@gmail.com' AND contraseña like 'dani1234'";

    
    $resultado = mysqli_query($conexion, $sql);
    $registro = mysqli_fetch_assoc($resultado);

    /*
    echo "<pre>";
    print_r($registro);
    echo "</pre>";
    */

    if($registro){
        $_SESSION["nombre"] = $registro["nombre"];
        $_SESSION["telefono"] = $registro["telefono"];
        $_SESSION["correo"] = $registro["correo"];
        $_SESSION["password"] = $registro["contraseña"];
        $_SESSION["categoria"] = $registro["categoria"];
        $_SESSION["logeado"] = true;
        echo "ok";
    } else {
        echo "ko";
    }
    mysqli_close($conexion);
?>