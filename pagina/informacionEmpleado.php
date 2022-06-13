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
        <title>Información personal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/pagina/informacionEmpleado.css" />
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

            include "../conexion/conexion.php";
            
            $id = $_SESSION["id"];
            
            $sql = "SELECT * FROM empleados WHERE id like '$id'";
            $resultado = mysqli_query($conexion, $sql);
            $registro = mysqli_fetch_assoc($resultado);

            switch ($registro["categoria"]) {
                case 'jefe':
                    $categoria = "Jefe de Proyecto";
                    break;

                case 'analista':
                    $categoria = "Analista";
                    break;

                case 'programador':
                    $categoria = "Programador";
                    break;
            }

        ?>

<div id="formularioInformacion" style="width: 100%;overflow-x:hidden;">
<div class="container-fluid">
<div class="row">

<div class="col-md-5 mx-auto">
        <h1 id="titulo" ><strong>Información empleado</strong></h1>
        <div class="card shadow-lg p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputNombre" class="form-label">Nombre empleado:</label>
                                <input type="text" class="form-control" id="inputNombre" <?php echo "value='$registro[nombre]'"?> disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputTelefono" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" id="inputTelefono"<?php echo "value='$registro[telefono]'"?> disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputCorreo" class="form-label">Correo:</label>
                                <input type="text" class="form-control" id="inputCorreo"<?php echo "value='$registro[correo]'"?> disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="inputPassword" class="form-label">Contraseña</label>
                        <div class="input-group mb-3">
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control"<?php echo "value='$registro[contraseña]'"?> disabled>
                            <button id="botonContraseña" name="botonContraseña" class="btn btn-secondary" type="button"><i id="ojoContraseña" class="fa-solid fa-eye"></i></button>
                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="selectCategoria" class="form-label">Categoría:</label>
                            <input type="text" class="form-control" id="selectCategoria"<?php echo "value='$categoria'"?> disabled>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <button type="button" id="botonEditar" name="botonEditar" class="btn btn-outline-secondary" style="margin-top: 31px;margin-right: 7%;">Editar <i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" id="botonActualizar" name="botonActualizar" class="btn btn btn-success" style="margin-top: 31px;" disabled>Actualizar <i class="fa-solid fa-floppy-disk"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</div>
</div>
</div>



<!-- Modal con actualizacion -->
<div class="modal fade" data-bs-backdrop="static" id="modalActualizacion" tabindex="-1" aria-labelledby="modalActualizacionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalActualizacionLabel">Actualización</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h5><strong>Actualización realizada de forma correcta.</strong></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" id="botonModalCerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal con actualizacion -->

<!-- Modal error actualizacion -->
<div class="modal fade" data-bs-backdrop="static" id="modalError" tabindex="-1" aria-labelledby="modalErrorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalErrorLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <h5><strong>Error en la actualización.</strong></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal error actualizacion -->

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

    <?php
        include "componentes/footer.php";
    ?>


<script type="text/javascript" src="../javascript/informacionEmpleado.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript">
    var modalActualizacion = new bootstrap.Modal(document.getElementById('modalActualizacion'));
    var modalError = new bootstrap.Modal(document.getElementById('modalError'));
    var modalValidacion = new bootstrap.Modal(document.getElementById('modalValidacion'));


</script>


</body>
</html>
