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
        <title>Listado partes de trabajo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/pagina/listadoTareas.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </head>
    <body style="overflow-x:hidden" id="cuerpo">
        <?php
            include "componentes/navbar.php";
        ?>



<div>

<div style="text-align:center;padding-top: 1%;">
<div id="formularioInformacion" style="width: 100%;overflow-x:hidden;">
<div class="container-fluid">
<div class="row">
<h1><strong><ins>Listado partes de trabajo</strong></ins></h1>
    <table id='tablaPartes' name='tablaPartes' class='table table-striped' style='width:100%'>
        <thead>
            <tr>
                <th>Actividad asociada</th>
                <th>Codigo tarea</th>
                <th>Nombre tarea</th>
                <th>Descripcion tarea</th>
                <th>Fecha</th>
                <th>Horas</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody id="cuerpoTareas">
        <tbody>
    </table>
</div>
</div>
</div>

</div>



</div>


<!-- Modal con parte de trabajo -->
<div class="modal fade" data-bs-backdrop="static" id="modalParteTrabajo" tabindex="-1" aria-labelledby="modalParteTrabajoLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalParteTrabajoLabel">Crear parte de trabajo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                    <label for="inputNombreActividadParte" class="form-label">Actividad:</label>
                    <select class="form-select" id="inputNombreActividadParte" aria-label="Default select example">
                            <?php
                            include "../conexion/conexion.php";

                            $sql = "SELECT id, nombre FROM actividad";
                            echo "<option value = 'no'>Seleccione una actividad</option>";
                            $resultado = mysqli_query($conexion, $sql);
                            while($registro = mysqli_fetch_assoc($resultado)){
                                $nombre = $registro["nombre"];
                                $id = $registro["id"];
                                echo "<option value=$id>$nombre</option>";
                            }

                            ?>

                         </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="inputFechaActividadParte" class="form-label">Fecha creación:</label>
                        <input  type="text" class="form-control" id="inputFechaActividadParte" style="background-color:white;">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="inputHorasActividadParte" class="form-label">Horas:</label>
                        <input  type="text" class="form-control" id="inputHorasActividadParte">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="inputTareasActividadParte" class="form-label">Tareas:</label>
                        <select class="form-select" id="inputTareasActividadParte" aria-label="Default select example">
                            <?php
                            include "../conexion/conexion.php";

                            $sql = "SELECT tarcod FROM tarea";
                            echo "<option value = 'no'>Seleccione una tarea</option>";
                            $resultado = mysqli_query($conexion, $sql);
                            while($registro = mysqli_fetch_assoc($resultado)){
                                $codigo = $registro["tarcod"];
                                echo "<option value=$codigo>$codigo</option>";
                            }

                            ?>

                         </select>
                        </div>
                    </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="inputNombreTareaActividad" class="form-label">Nombre tarea:</label>
                        <input disabled type="text" class="form-control" id="inputNombreTareaActividad">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="inputDescripcionTareaParte" class="form-label">Descripción:</label>
                        <textarea disabled class="form-control" id="inputDescripcionTareaParte" cols="50" maxlength="400" style="height: 135px;"></textarea>
                    </div>
                </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="botonModificarParte" class="btn btn-success">Modificar parte</button>
        <button type="button" id="botonCerrarParte" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
        <input type="hidden" id="idParteTrabajo">
      </div>
    </div>
  </div>
</div>
<!-- Modal con parte de trabajo -->

<!-- Modal eliminar -->
<div class="modal fade" data-bs-backdrop="static" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #ff7f7f;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarLabel">Eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h5><strong>Parte de trabajo eliminado correctamente.</strong></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" id="botonModalCerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal eliminar -->

        <?php
            include "componentes/footer.php";
        ?>
    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script type="text/javascript" src="../javascript/listadoPartesTrabajo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.js"></script>

    <script type="text/javascript">
        var modalParteTrabajo = new bootstrap.Modal(document.getElementById('modalParteTrabajo'));
        var modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminar'));
    </script>


<script type="text/javascript">
    $(document).ready(function() {
        const myTimeout = setTimeout(crearDatatable, 100);

        function crearDatatable(){
            $('#tablaPartes').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text:'<i class="fa-regular fa-file-excel fa-2xl"></i>',
                    className: "botonExcel",
                    exportOptions: {
                        columns: [ 0,1, 2, 3,4,5]
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa-regular fa-file-pdf fa-2xl"></i>',
                    className: "botonPDF",
                    exportOptions: {
                        columns: [ 0,1, 2, 3,4,5]
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
                        columns: [ 0,1, 2, 3,4,5]
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
            "search": "Buscar partes de trabajo:",
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

<script type="text/javascript">
            flatpickr('#inputFechaActividadParte', {
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

</body>
</html>