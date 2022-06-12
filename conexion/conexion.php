<?php

$servidor  = "localhost";
$usuario   = "root";
$password  = "";
$basedatos = "gestionproyectos";

$conexion = mysqli_connect($servidor, $usuario, $password, $basedatos) or die(mysqli_error($conexion));
$conexion->set_charset("utf8");

?>