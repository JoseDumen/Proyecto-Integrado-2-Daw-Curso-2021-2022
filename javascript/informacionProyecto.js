"use strict";

document.querySelector("#botonEditarProyecto").addEventListener("click", editar);
document.querySelector("#botonActualizarProyecto").addEventListener("click", actualizar);
document.querySelector("#botonModalCerrar").addEventListener("click",cerrar);
document.querySelector("#botonAltaActividad").addEventListener("click",mostrar);
document.querySelector("#altaActividad").addEventListener("click", altaActividad);
document.querySelector("#cerrarModalAlta").addEventListener("click", vaciarModalActividad);

function editar() {
    document.querySelector("#inputNombre").disabled = false;
    document.querySelector("#inputImporte").disabled = false;    
    document.querySelector("#inputFechaInicio").disabled = false;
    document.querySelector("#inputFechaFin").disabled = false;
    document.querySelector("#botonActualizarProyecto").disabled = false;
    document.querySelector("#inputDescripcion").disabled = false;
    document.querySelector("#inputCliente").disabled = false;

    document.querySelector("#inputFechaInicio").style.backgroundColor="white";
    document.querySelector("#inputFechaFin").style.backgroundColor="white";
    
}

function actualizar() {
    let idProyecto = document.querySelector("#idProyecto").value;
    let nombreProyecto = document.querySelector("#inputNombre").value;
    let importeProyecto = parseFloat(document.querySelector("#inputImporte").value.trim().replace(",","."));
    let fechaIProyecto = document.querySelector("#inputFechaInicio").value;
    let fechaFProyecto = document.querySelector("#inputFechaFin").value;
    let descripcionProyecto = document.querySelector("#inputDescripcion").value;
    let clienteProyecto = document.querySelector("#inputCliente").value;






    let correcto = true;
    
    let fechaInicioPartida = fechaIProyecto.split("/");
    let fechaFinPartida = fechaFProyecto.split("/");

    let fechaInicioBBDD = fechaInicioPartida[2]+"-"+fechaInicioPartida[1]+"-"+fechaInicioPartida[0];
    let fechaFinBBDD = fechaFinPartida[2]+"-"+fechaFinPartida[1]+"-"+fechaFinPartida[0];
    
    if (nombreProyecto != "") {
        document.querySelector("#inputNombre").classList.remove("is-invalid");
        document.querySelector("#inputNombre").classList.add("is-valid");
        if(document.querySelector("#liNombre") != undefined){
            document.querySelector("#liNombre").remove();
        }
        
    } else {
        document.querySelector("#inputNombre").classList.remove("is-valid");
        document.querySelector("#inputNombre").classList.add("is-invalid");
        if(document.querySelector("#liNombre") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liNombre'><strong>- El nombre del proyecto está vacío.</strong></h5>";
        }
        
        correcto = false;        
    }
    
    if (!isNaN(importeProyecto)) {
        document.querySelector("#inputImporte").classList.remove("is-invalid");
        document.querySelector("#inputImporte").classList.add("is-valid");
        if(document.querySelector("#liImporte") != undefined){
            document.querySelector("#liImporte").remove();
        }
        
    } else {
        document.querySelector("#inputImporte").classList.remove("is-valid");
        document.querySelector("#inputImporte").classList.add("is-invalid");
        if(document.querySelector("#liImporte") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liImporte'><strong>- El importe está vacío o no tiene el formato correcto.</strong></h5>";
        }
        
        correcto = false;        
    }
    
    if (descripcionProyecto != "") {
        document.querySelector("#inputDescripcion").classList.remove("is-invalid");
        document.querySelector("#inputDescripcion").classList.add("is-valid");
        if(document.querySelector("#liDescripcion") != undefined){
            document.querySelector("#liDescripcion").remove();
        }
        
    } else {
        document.querySelector("#inputDescripcion").classList.remove("is-valid");
        document.querySelector("#inputDescripcion").classList.add("is-invalid");
        if(document.querySelector("#liDescripcion") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liDescripcion'><strong>- La descripción está vacía.</strong></h5>";
        }
        
        correcto = false;        
    }
    
    
    if (clienteProyecto != "") {
        document.querySelector("#inputCliente").classList.remove("is-invalid");
        document.querySelector("#inputCliente").classList.add("is-valid");
        if(document.querySelector("#liCliente") != undefined){
            document.querySelector("#liCliente").remove();
        }
        
    } else {
        document.querySelector("#inputCliente").classList.remove("is-valid");
        document.querySelector("#inputCliente").classList.add("is-invalid");
        if(document.querySelector("#liCliente") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liCliente'><strong>- La información del cliente está vacía.</strong></h5>";
        }
        
        correcto = false;        
    }
    
    
    if (fechaIProyecto != "") {
        document.querySelector("#inputFechaInicio").classList.remove("is-invalid");
        document.querySelector("#inputFechaInicio").classList.add("is-valid");
        if(document.querySelector("#liFechaInicio") != undefined){
            document.querySelector("#liFechaInicio").remove();
        }
        
        
    } else {
        document.querySelector("#inputFechaInicio").classList.remove("is-valid");
        document.querySelector("#inputFechaInicio").classList.add("is-invalid");
        if(document.querySelector("#liFechaInicio") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liFechaInicio'><strong>- La fecha de inicio de proyecto está vacío.</strong></h5>";
        }
        
        correcto = false;        
    }
    
    
    if (fechaFProyecto != "") {
        document.querySelector("#inputFechaFin").classList.remove("is-invalid");
        document.querySelector("#inputFechaFin").classList.add("is-valid");
        if(document.querySelector("#liFechaFin") != undefined){
            document.querySelector("#liFechaFin").remove();
        }
        
    } else {
        document.querySelector("#inputFechaFin").classList.remove("is-valid");
        document.querySelector("#inputFechaFin").classList.add("is-invalid");
        if(document.querySelector("#liFechaFin") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liFechaFin'><strong>- La fecha de fin de está vacía.</strong></h5>";
        }
        
        correcto = false;        
    }

    if(!correcto){
        modalValidacion.toggle();
    } else {
        let options = {
            method: "POST",
            body: JSON.stringify({ id:idProyecto, nombre: nombreProyecto, importe: importeProyecto, descripcion: descripcionProyecto, cliente: clienteProyecto, fechaI: fechaInicioBBDD, fechaF: fechaFinBBDD }),
            headers: {
                'Content-Type': 'application/json'// AQUI indicamos el formato
            }
        };
    
        fetch("../php/actualizarProyecto.php", options)
            .then(respuesta => respuesta.text())
            .then(texto => responder(texto));
    }
}

function responder(texto){
    switch (texto) {
        case "ok":
            modalActualizacion.toggle();
            break;

        case "ko":
            modalError.toggle();
            break;
    }

}

function cerrar() {
    document.querySelector("#inputNombre").disabled = true;
    document.querySelector("#inputImporte").disabled = true;    
    document.querySelector("#inputFechaInicio").disabled = true;
    document.querySelector("#inputFechaFin").disabled = true;
    document.querySelector("#botonActualizarProyecto").disabled = true;
    document.querySelector("#inputDescripcion").disabled = true;
    document.querySelector("#inputCliente").disabled = true;

    document.querySelector("#inputFechaInicio").style.backgroundColor="";
    document.querySelector("#inputFechaFin").style.backgroundColor="";
    
}

function mostrar() {
    modalAltaActividad.toggle();
    
}

function vaciarModalActividad() {
    document.querySelector("#inputNombreActiivdad").value = "";
    document.querySelector("#inputHorasActividad").value = "";
    document.querySelector("#inputFechaInicioActividad").value = "";
    document.querySelector("#inputFechaFinActividad").value = "";
    document.querySelector("#inputDescripcionActividad").value = "";
    
    document.querySelector("#inputNombreActiivdad").classList.remove("is-invalid");
    document.querySelector("#inputHorasActividad").classList.remove("is-invalid");
    document.querySelector("#inputFechaInicioActividad").classList.remove("is-invalid");
    document.querySelector("#inputFechaFinActividad").classList.remove("is-invalid");
    document.querySelector("#inputDescripcionActividad").classList.remove("is-invalid");

    document.querySelector("#inputNombreActiivdad").classList.remove("is-valid");
    document.querySelector("#inputHorasActividad").classList.remove("is-valid");
    document.querySelector("#inputFechaInicioActividad").classList.remove("is-valid");
    document.querySelector("#inputFechaFinActividad").classList.remove("is-valid");
    document.querySelector("#inputDescripcionActividad").classList.remove("is-valid");
    
}

function altaActividad() {
    let idProyecto = document.querySelector("#idProyecto").value.triom();
    let nombreActiivdad = document.querySelector("#inputNombreActiivdad").value.trim();
    let horasActiivdad = parseInt(document.querySelector("#inputHorasActividad").value.trim());
    let fechaIActiivdad = document.querySelector("#inputFechaInicioActividad").value.trim();
    let fechaFActiivdad = document.querySelector("#inputFechaFinActividad").value.trim();
    let descripcionActiivdad = document.querySelector("#inputDescripcionActividad").value.trim();

    let correcto = true;

    if (nombreActiivdad != "") {
        document.querySelector("#inputNombreActiivdad").classList.remove("is-invalid");
        document.querySelector("#inputNombreActiivdad").classList.add("is-valid");

    } else {
        document.querySelector("#inputNombreActiivdad").classList.remove("is-valid");
        document.querySelector("#inputNombreActiivdad").classList.add("is-invalid");

        correcto = false;
    }

    if (!isNaN(horasActiivdad)) {
        document.querySelector("#inputHorasActividad").classList.remove("is-invalid");
        document.querySelector("#inputHorasActividad").classList.add("is-valid");


    } else {
        document.querySelector("#inputHorasActividad").classList.remove("is-valid");
        document.querySelector("#inputHorasActividad").classList.add("is-invalid");

        correcto = false;
    }

    if (descripcionActiivdad != "") {
        document.querySelector("#inputDescripcionActividad").classList.remove("is-invalid");
        document.querySelector("#inputDescripcionActividad").classList.add("is-valid");


    } else {
        document.querySelector("#inputDescripcionActividad").classList.remove("is-valid");
        document.querySelector("#inputDescripcionActividad").classList.add("is-invalid");

        correcto = false;
    }

    if (fechaIActiivdad != "") {
        document.querySelector("#inputFechaInicioActividad").classList.remove("is-invalid");
        document.querySelector("#inputFechaInicioActividad").classList.add("is-valid");

    } else {
        document.querySelector("#inputFechaInicioActividad").classList.remove("is-valid");
        document.querySelector("#inputFechaInicioActividad").classList.add("is-invalid");

        correcto = false;
    }


    if (fechaFActiivdad != "") {
        document.querySelector("#inputFechaFinActividad").classList.remove("is-invalid");
        document.querySelector("#inputFechaFinActividad").classList.add("is-valid");

    } else {
        document.querySelector("#inputFechaFinActividad").classList.remove("is-valid");
        document.querySelector("#inputFechaFinActividad").classList.add("is-invalid");

        correcto = false;
    }

    if(correcto){

        let options = {
            method: "POST",
            body: JSON.stringify({ id: idProyecto, nombre: nombreActiivdad, horas:horasActiivdad , fechaI: fechaIActiivdad, fechaF: fechaFActiivdad, descripcion: descripcionActiivdad }),
            headers: {
                'Content-Type': 'application/json'// AQUI indicamos el formato
            }
        };

        fetch("../php/darAltaActividad.php", options)
            .then(respuesta => respuesta.text())
            .then(texto => responder(texto));
    }
    
    
}