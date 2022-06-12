<html lang="es">
    <head>
        <title>Inicio de sesión</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/index/index.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center" id="rowContenido">
                <div class="col-md-4 align-self-center" id="colContenido">
                    <div class="border border-5 rounded-3" id="divFormulario">
                    <form action="" method="POST">
                    <h1>Control de Proyectos</h1>
                        <label for="correo" class="form-label">Correo</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="correo" name="correo" aria-describedby="basic-addon3">
                        </div>
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <div class="input-group mb-3">
                            <input type="password" id="contraseña" name="contraseña" class="form-control">
                            <button id="botonContraseña" name="botonContraseña" class="btn btn-secondary" type="button"><i id="ojoContraseña" class="fa-solid fa-eye"></i></button>
                        </div>
                        <div>
                            <button type="button" id="iniciarSesion" name="iniciarSesion" class="btn btn-secondary">Iniciar sesión</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="javascript/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>