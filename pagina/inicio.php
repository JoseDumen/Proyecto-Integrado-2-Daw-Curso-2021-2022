<?php
session_start();

if(isset($_SESSION["logeado"]) && $_SESSION["logeado"] == true){
    //echo "Conectado";

} else {
    header('Location: ../index.php');

}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Inicio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <style>
        @media only screen and (max-width: 600px) {
            #footer {
                position: relative;
            }
        }

    </style>
    </head>
    <body>
        <?php
            include "componentes/navbar.php";
        ?>



<div>
    <?php
        include "../conexion/conexion.php";

        $fechaHoy = date('Y-m-d');
        $sql = "SELECT * FROM proyecto WHERE fechaFin > '$fechaHoy'";
        $resultado = mysqli_query($conexion, $sql);
        $registro = mysqli_fetch_assoc($resultado);

        if(!$registro){
$div = <<<EOT
<div style="text-align:center;padding-top: 10%;">
<h2>No hay ningun proyecto creado actualmente, pulse el boton de abajo para crearlo</h2>
<button type="button" id="botonCrearProyecto" class="btn btn-outline-primary" style="margin-top: 5%;font-size: 40px;">Crear proyecto</button>
</div>
EOT;

        echo $div;


        } else {
echo "<div style='text-align:center;padding-top: 2%;'><h1><ins>Proyectos activos</ins></h1></div>";
$proyecto = <<<EOT
<div style="text-align:center;padding-top: 2%;">
<div id="formularioAlta" style="width: 100%;overflow-x:hidden;">
<div class="container-fluid">
<div class="row">
EOT;

$fechaHoy = date('Y-m-d');

$sql = "SELECT * FROM proyecto WHERE fechaFin > '$fechaHoy'";
$resultado = mysqli_query($conexion, $sql);

while($registro = mysqli_fetch_assoc($resultado)){
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

$proyecto .= <<<EOT
    <div class="col-md-6 mx-auto">
            <h1 id="titulo" ><strong>$nombre</strong></h1>
            <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputDescripcion" class="form-label">Descripción:</label>
                                <textarea disabled class="form-control" id="inputDescripcion" cols="50" maxlength="400" style="height: 70px;">$descripcion</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputCliente" class="form-label">Información cliente:</label>
                                <textarea disabled class="form-control" id="inputCliente" cols="50" maxlength="400" style="height: 70px;">$datosCliente</textarea>
                            </div>
                        </div>
                    </div>
                        <div class="row">
    
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="inputImporte" class="form-label">Importe:</label>
                                    <input disabled type="text" class="form-control" id="inputImporte" value="$importe">
                                </div>
                            </div>
    
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="inputFechaInicio" class="form-label">Fecha inicio:</label>
                                    <input disabled type="text" class="form-control" id="inputFechaInicio" name="inputFechaInicio" value="$fechaInicioFormateada">
    
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="inputFechaFin" class="form-label">Fecha fin:</label>
                                    <input disabled type="text" class="form-control" id="inputFechaFin" name="inputFechaFin" value="$fechaFinFormateada">
                                </div>
                            </div>
                            <div class="col-md-3 mx-auto">
                                <button type="button" id="botonVerProyecto" onclick="verProyecto($id)" name="botonVerProyecto" class="btn btn-outline-success" style="margin-top: 11%;">Ver proyecto</button>
                            </div>
    
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
EOT;


}
$proyecto .= <<<EOT
</div>
</div>
</div>

</div>
EOT;
echo $proyecto;



        }




    ?>

</div>




        <?php
            include "componentes/footer.php";
        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        if(document.querySelector("#botonCrearProyecto") != undefined){
            document.querySelector("#botonCrearProyecto").addEventListener("click", crearProyecto);
        }


        function crearProyecto(){
            window.location = "altaProyecto.php";
        }

        function verProyecto(id){
            window.location = "informacionProyecto.php?id="+id;
        }

    </script>

</body>
</html>
