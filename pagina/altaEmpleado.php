<?php
session_start();

if(isset($_SESSION["logeado"]) && $_SESSION["logeado"] == true){
    //echo "Conectado";

} else {
    header('Location: ../index.php');

}

?>
<html lang="es">
    <head>
        <title>Alta empleado</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/pagina/altaEmpleado.css" />
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

<div id="formularioAlta" style="width: 100%;overflow-x:hidden;">
<div class="container-fluid">
<div class="row">

<div class="col-md-5 mx-auto">
        <h1 id="titulo" ><strong>Alta empleado</strong></h1>
        <div class="card shadow-lg p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputNombre" class="form-label">Nombre empleado:</label>
                                <input type="text" class="form-control" id="inputNombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputTelefono" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" id="inputTelefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputCorreo" class="form-label">Correo:</label>
                                <input type="text" class="form-control" id="inputCorreo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="inputPassword" class="form-label">Contraseña</label>
                        <div class="input-group mb-3">
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control">
                            <button id="botonContraseña" name="botonContraseña" class="btn btn-secondary" type="button"><i id="ojoContraseña" class="fa-solid fa-eye"></i></button>
                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="selectCategoria" class="form-label">Categoría:</label>
                            <select class="form-select" id="selectCategoria">
                                <option value="sin">Seleccione la categoría</option>
                                <option value="jefe">Jefe de proyecto</option>
                                <option value="analista">Analista</option>
                                <option value="programador">Programador</option>
                            </select>
                        </div>
                        <div class="col-md-5 mx-auto">
                            <button type="button" id="botonAlta" name="botonAlta" class="btn btn-success" style="margin-top: 11%;">Dar de alta</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</div>
</div>
</div>



<!-- Modal con información de la validación -->
<div class="modal fade" data-bs-backdrop="static" id="modalValidacion" tabindex="-1" aria-labelledby="modalValidacionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalValidacionLabel">Validación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div id="listaValidacion"></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal con información de la validación -->


<!-- Modal existe usuario -->
<div class="modal fade" data-bs-backdrop="static" id="modalExiste" tabindex="-1" aria-labelledby="modalExisteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExisteLabel">Validación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5><strong>Ya existe un usuario con ese correo.</strong></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal existe usuario -->

<!-- Modal alta correcta -->
<div class="modal fade" data-bs-backdrop="static" id="modalAlta" tabindex="-1" aria-labelledby="modalAltaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content"style="background-color: #87D37C;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAltaLabel">Validación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5><strong>Alta realizada correctamente.</strong></h5>
        <h5><strong>Recuerdele al nuevo empleado que cambie la contraseña.</strong></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal alta correcta -->

<!-- Modal alta erronea -->
<div class="modal fade" data-bs-backdrop="static" id="modalAltaErronea" tabindex="-1" aria-labelledby="modalAltaErroneaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAltaErroneaLabel">ERROR</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5><strong>Ha fallado el alta de empleado.</strong></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal alta erronea -->


    <?php
        include "componentes/footer.php";
    ?>


<script type="text/javascript" src="../javascript/altaEmpleado.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
    var modalValidacion = new bootstrap.Modal(document.getElementById('modalValidacion'));
    var modalExiste = new bootstrap.Modal(document.getElementById('modalExiste'));
    var modalAlta = new bootstrap.Modal(document.getElementById('modalAlta'));
    var modalAltaErronea = new bootstrap.Modal(document.getElementById('modalAltaErronea'));

</script>


</body>
</html>
