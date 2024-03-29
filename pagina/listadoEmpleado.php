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
        <title>Listado de empleados</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/pagina/listadoEmpleado.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.css"/>
 
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
        <div id="listado"></div>









        <?php
            include "componentes/footer.php";
        ?>


<!-- Modal con actualizacion -->
<div class="modal fade" data-bs-backdrop="static" id="modalActualizacion" tabindex="-1" aria-labelledby="modalActualizacionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #87D37C;">
      <div class="modal-header">
        <h5 class="modal-title" id="modalActualizacionLabel">Actualización</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h5><strong>Estado actualizado de forma correcta.</strong></h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" id="botonModalCerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal con actualizacion -->








    <!-- CDN js -->
    <script type="text/javascript" src="../javascript/listadoEmpleado.js"></script>
    
    <!-- CDN Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- CDNs Datatables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        const myTimeout = setTimeout(crearDatatable, 100);

        function crearDatatable(){
            $('#tablaEmpleados').DataTable( {
            order: [[5, 'asc']],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text:'<i class="fa-regular fa-file-excel fa-2xl"></i>',
                    className: "botonExcel",
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 5 ]
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa-regular fa-file-pdf fa-2xl"></i>',
                    className: "botonPDF",
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 5 ]
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
                        columns: [ 0, 1, 2, 3, 5 ]
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
            "search": "Buscar empleado:",
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
    var modalActualizacion = new bootstrap.Modal(document.getElementById('modalActualizacion'));

</script>


</body>
</html>
