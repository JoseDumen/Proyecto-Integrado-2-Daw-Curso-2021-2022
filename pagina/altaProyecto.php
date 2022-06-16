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
        <title>Alta proyecto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/pagina/altaProyecto.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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

<div class="col-md-6 mx-auto">
        <h1 id="titulo" ><strong>Alta proyecto</strong></h1>
        <div class="card shadow-lg p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputNombre" class="form-label">Nombre proyecto:</label>
                                <input type="text" class="form-control" id="inputNombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputImporte" class="form-label">Importe:</label>
                                <input type="text" class="form-control" id="inputImporte">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputDescripcion" class="form-label">Descripción:</label>
                                <textarea class="form-control" id="inputDescripcion" cols="50" maxlength="400" style="height: 160px;"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputCliente" class="form-label">Información cliente:</label>
                                <textarea class="form-control" id="inputCliente" cols="50" maxlength="400" style="height: 160px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="inputFechaInicio" class="form-label">Fecha inicio:</label>
                                <input type="text" class="form-control" id="inputFechaInicio" name="inputFechaInicio"style="background-color: white;">
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="inputFechaFin" class="form-label">Fecha fin:</label>
                                <input type="text" class="form-control" id="inputFechaFin" name="inputFechaFin"style="background-color: white;">
                            </div>
                        </div>
                        <div class="col-md-4 mx-auto">
                            <button type="button" id="botonCrear" name="botonCrear" class="btn btn-success" style="margin-top: 11%;">Crear proyecto</button>
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

<!-- Modal alta correcta -->
<div class="modal fade" data-bs-backdrop="static" id="modalAlta" tabindex="-1" aria-labelledby="modalAltaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #87D37C;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAltaLabel">Correcto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5><strong>Proyecto dado de alta correctamente.</strong></h5>
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
        <h5><strong>Ha fallado el alta de proyecto.</strong></h5>
        
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


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript" src="../javascript/altaProyecto.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    var modalValidacion = new bootstrap.Modal(document.getElementById('modalValidacion'));
    var modalAlta = new bootstrap.Modal(document.getElementById('modalAlta'));
    var modalError = new bootstrap.Modal(document.getElementById('modalAltaErronea'));

</script>
<script type="text/javascript">
flatpickr('#inputFechaInicio', {
    minDate: "today",
    weekNumbers: true,
    dateFormat: "d-m-Y",
    locale: {
        firstDayOfWeek: 1,
        weekdays: {
          shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
          longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
        }, 
        months: {
          shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
          longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        },
      }
});
flatpickr('#inputFechaFin', {
  "minDate": new Date().fp_incr(1),
    weekNumbers: true,
    dateFormat: "d-m-Y",
    locale: {
        firstDayOfWeek: 1,
        weekdays: {
          shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
          longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
        }, 
        months: {
          shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
          longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        },
      }
});
</script>

</body>
</html>
