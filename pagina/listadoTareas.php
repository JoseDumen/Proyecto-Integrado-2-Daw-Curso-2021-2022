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
        <title>Listado tareas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/pagina/listadoTareas.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <style>
        @media only screen and (max-width: 600px) {
            #footer {
                position: relative;
            }
        }
        @media only screen and (min-width: 600px) {
            #footer {
                position: relative;
            }
        }

    </style>
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
    <div class="col-md-6 mx-auto">
            <h1><strong><ins>Crear tarea</strong></ins></h1>
            <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <form>
                    <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="inputCodigo" class="form-label">Código:</label>
                            <input  type="text" class="form-control" id="inputCodigo" value="">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="inputNombre" class="form-label">Nombre tarea:</label>
                            <input  type="text" class="form-control" id="inputNombre" value="">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="inputDescripcion" class="form-label">Descripción:</label>
                            <textarea  class="form-control" id="inputDescripcion" cols="50" maxlength="400" style="height: 64px;"></textarea>
                        </div>
                    </div>
                    <div class="col-md-2 mx-auto">
                        <button type="button" id="botonCrearTarea" class="btn btn-outline-success" style="margin-top: 20%;">Crear</button>
                    </div>
                </div>

                        </div>
                </div>
                        
                    </form>
                </div>
            </div>
        </div>




</div>
<div class="row">
<h1><strong><ins>Listado tareas</strong></ins></h1>
    <table id='tablaTareas' name='tablaTareas' class='table table-striped' style='width:100%'>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
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

<!-- Modal con alta -->
<div class="modal fade" data-bs-backdrop="static" id="modalAlta" tabindex="-1" aria-labelledby="modalAltaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #87D37C;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAltaLabel">Alta de tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h5><strong>Tarea subida con exito.</strong></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" id="botonModalCerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal con alta -->

<!-- Modal eliminar -->
<div class="modal fade" data-bs-backdrop="static" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #ff7f7f;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarLabel">Eliminación de tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h5><strong>Tarea eliminada con exito.</strong></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" id="botonModalCerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal eliminar -->

<!-- Modal modificar -->
<div class="modal fade" data-bs-backdrop="static" id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalModificarLabel">Eliminación de tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form>
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="inputCodigoActualizar" class="form-label">Código:</label>
                <input  type="text" class="form-control" id="inputCodigoActualizar" value="">
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label for="inputNombreActualizar" class="form-label">Nombre tarea:</label>
                <input  type="text" class="form-control" id="inputNombreActualizar" value="">

            </div>
        </div>

        <div class="col-md-3 mx-auto">
            <button type="button" id="botonActualizarTarea" class="btn btn-outline-success" style="margin-top: 20%;">Actualizar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="inputDescripcionActualizar" class="form-label">Descripción:</label>
                <textarea  class="form-control" id="inputDescripcionActualizar" cols="50" maxlength="400" style="height: 64px;"></textarea>
            </div>
        </div>
    </div>
</form>
        
      </div>
      <div class="modal-footer">
        <button type="button" id="botonModalCerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal modificar -->



        <?php
            include "componentes/footer.php";
        ?>

    <script type="text/javascript" src="../javascript/listadoTareas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.js"></script>

    <script type="text/javascript">
        var modalValidacion = new bootstrap.Modal(document.getElementById('modalValidacion'));
        var modalError = new bootstrap.Modal(document.getElementById('modalError'));
        var modalActualizacion = new bootstrap.Modal(document.getElementById('modalActualizacion'));
        var modalAlta = new bootstrap.Modal(document.getElementById('modalAlta'));
        var modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminar'));
        var modalModificar = new bootstrap.Modal(document.getElementById('modalModificar'));
    </script>


<script type="text/javascript">
    $(document).ready(function() {
        const myTimeout = setTimeout(crearDatatable, 100);

        function crearDatatable(){
            $('#tablaTareas').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text:'<i class="fa-regular fa-file-excel fa-2xl"></i>',
                    className: "botonExcel",
                    exportOptions: {
                        columns: [ 0, 1, 2]
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa-regular fa-file-pdf fa-2xl"></i>',
                    className: "botonPDF",
                    exportOptions: {
                        columns: [ 0, 1, 2]
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
                        columns: [ 0, 1, 2]
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
            "search": "Buscar tarea:",
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