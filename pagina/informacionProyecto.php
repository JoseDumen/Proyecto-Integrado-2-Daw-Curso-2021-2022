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
        <title>Información proyecto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/pagina/listadoEmpleado.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </head>
    <body>
        <?php
            include "componentes/navbar.php";
        ?>



<div>
    <?php
        include "../conexion/conexion.php";

        $id = $_GET["id"];

        $sql = "SELECT * FROM proyecto WHERE idProyecto like '$id'";
        $resultado = mysqli_query($conexion, $sql);
        $registro = mysqli_fetch_assoc($resultado);

$proyecto = <<<EOT
<div style="text-align:center;padding-top: 1%;">
<div id="formularioInformacion" style="width: 100%;overflow-x:hidden;">
<div class="container-fluid">
<div class="row">
EOT;

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
    <div class="col-md-7 mx-auto">
            <strong><ins><input disabled type="text" class="form-control" id="inputNombre" value="$nombre" style="border: none;font-size: larger;width: fit-content;font-weight: 1000;"></strong></ins>
            <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <form>
                    <div class="row">

                        <div class="col-md-2">
                        <div class="mb-3">
                            <label for="inputImporte" class="form-label">Importe:</label>
                            <input disabled type="text" class="form-control" id="inputImporte" value="$importe">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="inputFechaInicio" class="form-label">Fecha inicio:</label>
                            <input disabled type="text" class="form-control" id="inputFechaInicio" name="inputFechaInicio" value="$fechaInicioFormateada">

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="inputFechaFin" class="form-label">Fecha fin:</label>
                            <input disabled type="text" class="form-control" id="inputFechaFin" name="inputFechaFin" value="$fechaFinFormateada">
                        </div>
                    </div>
                    <div class="col-md-5 mx-auto">
                        <button type="button" id="botonEditarProyecto" name="botonEditarProyecto" class="btn btn-outline-secondary" style="margin-top: 9%;">Editar <i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" id="botonActualizarProyecto" name="botonActualizarProyecto" class="btn btn-success" style="margin-top: 9%; margin-left: 1%; margin-right: 1%;" disabled>Actualizar <i class="fa-solid fa-floppy-disk"></i></button>
                        <button type="button" id="botonAltaActividad" name="botonAltaActividad" class="btn btn-outline-info" style="margin-top: 9%;">Actividad <i class="fa-solid fa-folder-plus"></i></button>
                    </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="inputDescripcion" class="form-label">Descripción:</label>
                            <textarea disabled class="form-control" id="inputDescripcion" cols="50" maxlength="400" style="height: 64px;">$descripcion</textarea>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label for="inputCliente" class="form-label">Información cliente:</label>
                            <textarea disabled class="form-control" id="inputCliente" cols="50" maxlength="400" style="height: 64px;">$datosCliente</textarea>
                        </div>
                    </div>
    
                        </div>
                        <input type="hidden" id="idProyecto" name="idProyecto" value="$id">
                    </form>
                </div>
            </div>
        </div>
EOT;


$proyecto .= <<<EOT
</div>
<div class="row">
    <table id='tablaActividades' name='tablaActividades' class='table table-striped' style='width:100%'>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Horas</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Añadir tarea</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
    </table>
</div>
</div>
</div>

</div>
EOT;
echo $proyecto;

    ?>

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

<!-- Modal con actualizacion -->
<div class="modal fade" data-bs-backdrop="static" id="modalActualizacion" tabindex="-1" aria-labelledby="modalActualizacionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #87D37C;">
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



<!-- Modal con alta actividad -->
<div class="modal fade" data-bs-backdrop="static" id="modalAltaActividad" tabindex="-1" aria-labelledby="modalAltaActividadLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAltaActividadLabel">Alta de actividad</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="formularioAlta">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="inputNombreActiivdad" class="form-label">Nombre:</label>
                        <input  type="text" class="form-control" id="inputNombreActiivdad">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="inputHorasActividad" class="form-label">Horas:</label>
                        <input  type="text" class="form-control" id="inputHorasActividad">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="inputFechaInicioActividad" class="form-label">Fecha inicio:</label>
                        <input  type="text" class="form-control" id="inputFechaInicioActividad" name="inputFechaInicioActividad" style="background-color:white;">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="inputFechaFinActividad" class="form-label">Fecha fin:</label>
                        <input  type="text" class="form-control" id="inputFechaFinActividad" name="inputFechaFinActividad" style="background-color:white;">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="inputDescripcionActividad" class="form-label">Descripción:</label>
                        <textarea  class="form-control" id="inputDescripcionActividad" cols="50" maxlength="400" style="height: 135px;"></textarea>
                    </div>
                </div>
            </div>
          </form>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" id="altaActividad" class="btn btn-success">Alta</button>
        <button type="button" id="cerrarModalAlta" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal con alta actividad -->







        <?php
            include "componentes/footer.php";
        ?>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript" src="../javascript/informacionProyecto.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.js"></script>

    <script type="text/javascript">
        var modalValidacion = new bootstrap.Modal(document.getElementById('modalValidacion'));
        var modalError = new bootstrap.Modal(document.getElementById('modalError'));
        var modalActualizacion = new bootstrap.Modal(document.getElementById('modalActualizacion'));
        var modalAltaActividad = new bootstrap.Modal(document.getElementById('modalAltaActividad'));

    </script>

    <script type="text/javascript">

            flatpickr('#inputFechaInicio', {
                minDate: "today",
                weekNumbers: true,
                dateFormat: "d/m/Y",
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
                dateFormat: "d/m/Y",
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



            flatpickr('#inputFechaInicioActividad', {
                minDate: "today",
                weekNumbers: true,
                dateFormat: "d/m/Y",
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
            flatpickr('#inputFechaFinActividad', {
                "minDate": new Date().fp_incr(1),
                weekNumbers: true,
                dateFormat: "d/m/Y",
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

<script type="text/javascript">
    $(document).ready(function() {
        const myTimeout = setTimeout(crearDatatable, 100);

        function crearDatatable(){
            $('#tablaActividades').DataTable( {
            order: [[5, 'asc']],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text:'<i class="fa-regular fa-file-excel fa-2xl"></i>',
                    className: "botonExcel",
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa-regular fa-file-pdf fa-2xl"></i>',
                    className: "botonPDF",
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths = 
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa-solid fa-print fa-2xl"></i>',
                    className: "botonImpr",
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths = 
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                }
            ],
            "language": {
            "lengthMenu": "Mostrar _MENU_ lineas",
            "zeroRecords": "No se ha encontrado nada",
            "info": "Enseñando página _PAGE_ de _PAGES_",
            "search": "Buscar actividad:",
            "infoEmpty": "No hay información disponible",
            "infoFiltered": "(Filtrado de _MAX_ en total)",
            "paginate": {
            "first": "Primera",
            "last": "Ultima",
            "next": "Siguiente",
            "previous": "Anterior"
            }
        }
        } );
        
    } 

});
    
</script>





</body>
</html>
