"use strict";

ponerFechaInicio();

function ponerFechaInicio(){
    let fecha = new Date();
let dia = fecha.getDate();
let mes = fecha.getMonth() + 1;
let anno = fecha.getFullYear();

document.querySelector("#inputFechaInicio").value = dia+"-"+mes+"-"+anno;

}

document.querySelector("#botonCrear").addEventListener("click", crearProyecto);

function crearProyecto() {
    let nombreProyecto = document.querySelector("#inputNombre").value.trim();
    let importeProyecto = parseFloat(document.querySelector("#inputImporte").value.trim().replace(",","."));
    let descripcionProyecto = document.querySelector("#inputDescripcion").value.trim();
    let clienteProyecto = document.querySelector("#inputCliente").value.trim();
    let fechaInicioProyecto = document.querySelector("#inputFechaInicio").value.trim();
    let fechaFinProyecto = document.querySelector("#inputFechaFin").value.trim();

    let correcto = true;

    let fechaInicioPartida = fechaInicioProyecto.split("-");
    let fechaFinPartida = fechaFinProyecto.split("-");

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


    if (fechaInicioProyecto != "") {
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


    if (fechaFinProyecto != "") {
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
            body: JSON.stringify({ nombre: nombreProyecto, importe: importeProyecto, descripcion: descripcionProyecto, cliente: clienteProyecto, fechaI: fechaInicioBBDD, fechaF: fechaFinBBDD }),
            headers: {
                'Content-Type': 'application/json'// AQUI indicamos el formato
            }
        };

        fetch("../php/darAltaProyecto.php", options)
            .then(respuesta => respuesta.text())
            .then(texto => responder(texto));
    }

}

function responder(texto) {

    switch (texto) {
        case "ok":
            modalAlta.toggle();
            break;
        case "ko":
            modalError.toggle();
            break;


    }

}
