<?php
session_start();

if(isset($_SESSION["logeado"]) && $_SESSION["logeado"] == true){
    //echo "Conectado";

} else {
    header('Location: ../index.php');
    
}

?>

<html>
    <head>
        <title>Inicio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/pagina/listadoEmpleado.css" />
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
        


        <div class="col-md-6 mx-auto">
        <h1 id="titulo" ><strong>Listado empleados</strong></h1>
        </div>



        <?php
            include "componentes/footer.php";
        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>
