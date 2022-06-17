"use strict";

document.querySelector("#botonCrearTarea").addEventListener("click", crearTarea);
document.querySelector("#botonActualizarTarea").addEventListener("click", actualizar);

traerTareas();

function crearTarea() {
    let codigoTarea = document.querySelector("#inputCodigo").value.trim();
    let nombreTarea = document.querySelector("#inputNombre").value.trim();
    let descripcionTarea = document.querySelector("#inputDescripcion").value.trim();

    let correcto = true;

    if (codigoTarea != "") {
        document.querySelector("#inputCodigo").classList.remove("is-invalid");
        document.querySelector("#inputCodigo").classList.add("is-valid");
        if(document.querySelector("#liCodigo") != undefined){
            document.querySelector("#liCodigo").remove();
        }

    } else {
        document.querySelector("#inputCodigo").classList.remove("is-valid");
        document.querySelector("#inputCodigo").classList.add("is-invalid");
        if(document.querySelector("#liCodigo") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liCodigo'><strong>- El código de la tarea está vacío.</strong></h5>";
        }

        correcto = false;
    }

    if (nombreTarea != "") {
        document.querySelector("#inputNombre").classList.remove("is-invalid");
        document.querySelector("#inputNombre").classList.add("is-valid");
        if(document.querySelector("#liNombre") != undefined){
            document.querySelector("#liNombre").remove();
        }

    } else {
        document.querySelector("#inputNombre").classList.remove("is-valid");
        document.querySelector("#inputNombre").classList.add("is-invalid");
        if(document.querySelector("#liNombre") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liNombre'><strong>- El nombre de la tarea está vacío.</strong></h5>";
        }

        correcto = false;
    }

    if (descripcionTarea != "") {
        document.querySelector("#inputDescripcion").classList.remove("is-invalid");
        document.querySelector("#inputDescripcion").classList.add("is-valid");
        if(document.querySelector("#liDescripcion") != undefined){
            document.querySelector("#liDescripcion").remove();
        }

    } else {
        document.querySelector("#inputDescripcion").classList.remove("is-valid");
        document.querySelector("#inputDescripcion").classList.add("is-invalid");
        if(document.querySelector("#liDescripcion") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liDescripcion'><strong>- La descripción de la tarea está vacía.</strong></h5>";
        }

        correcto = false;
    }

    if(!correcto){
        modalValidacion.toggle();
    } else {
        let options = {
            method: "POST",
            body: JSON.stringify({ codigo: codigoTarea, nombre: nombreTarea, descripcion: descripcionTarea }),
            headers: {
                'Content-Type': 'application/json'// AQUI indicamos el formato
            }
        };

        fetch("../php/darAltaTarea.php", options)
            .then(respuesta => respuesta.text())
            .then(texto => {
                modalAlta.toggle();
                traerTareas();
            });
    }
    
}

function traerTareas() {
    let options = {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        }
    };
    
    fetch("../php/traerTareas.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => responderTraerActividades(texto));

}


function responderTraerActividades(texto) {
    let cuerpoTabla = document.querySelector("#cuerpoTareas");

    for(let i = 0; i< cuerpoTabla.children.length;i++){
        cuerpoTabla.children[i].remove();
    }

    cuerpoTabla.innerHTML = texto;

}

function eliminar(evento) {
    let oE = evento || window.event;

    let codigo = oE.target.parentElement.parentElement.children[0].innerHTML;

    let codigoEliminar = codigo;
    let options = {
        method: "POST",
        body: JSON.stringify({ codigo: codigoEliminar }),
        headers: {
            'Content-Type': 'application/json'
        }
    };

    fetch("../php/eliminarTarea.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => {
            modalEliminar.toggle();
            traerTareas();
        });
}

function modificar(evento) {
    let oE = evento || window.event;

    let codigo = oE.target.parentElement.parentElement.children[0].innerHTML;
    let nombre = oE.target.parentElement.parentElement.children[1].innerHTML;
    let descripcion = oE.target.parentElement.parentElement.children[2].innerHTML;

    document.querySelector("#inputCodigoActualizar").classList.remove("is-invalid");
    document.querySelector("#inputCodigoActualizar").classList.remove("is-valid");
    document.querySelector("#inputNombreActualizar").classList.remove("is-invalid");
    document.querySelector("#inputNombreActualizar").classList.remove("is-valid");
    document.querySelector("#inputDescripcionActualizar").classList.remove("is-invalid");
    document.querySelector("#inputDescripcionActualizar").classList.remove("is-valid");

    modalModificar.toggle();

    document.querySelector("#inputCodigoActualizar").value = codigo;
    document.querySelector("#inputNombreActualizar").value = nombre;
    document.querySelector("#inputDescripcionActualizar").value = descripcion;
    document.querySelector("#inputDescripcionActualizar").innerHTML = descripcion;

    
}

function actualizar() {

    let codigoTarea = document.querySelector("#inputCodigoActualizar").value.trim();
    let nombreTarea = document.querySelector("#inputNombreActualizar").value.trim();
    let descripcionTarea = document.querySelector("#inputDescripcionActualizar").value.trim();

    let correcto = true;

    if (codigoTarea != "") {
        document.querySelector("#inputCodigoActualizar").classList.remove("is-invalid");
        document.querySelector("#inputCodigoActualizar").classList.add("is-valid");


    } else {
        document.querySelector("#inputCodigoActualizar").classList.remove("is-valid");
        document.querySelector("#inputCodigoActualizar").classList.add("is-invalid");


        correcto = false;
    }

    if (nombreTarea != "") {
        document.querySelector("#inputNombreActualizar").classList.remove("is-invalid");
        document.querySelector("#inputNombreActualizar").classList.add("is-valid");


    } else {
        document.querySelector("#inputNombreActualizar").classList.remove("is-valid");
        document.querySelector("#inputNombreActualizar").classList.add("is-invalid");

        correcto = false;
    }

    if (descripcionTarea != "") {
        document.querySelector("#inputDescripcionActualizar").classList.remove("is-invalid");
        document.querySelector("#inputDescripcionActualizar").classList.add("is-valid");


    } else {
        document.querySelector("#inputDescripcionActualizar").classList.remove("is-valid");
        document.querySelector("#inputDescripcionActualizar").classList.add("is-invalid");

        correcto = false;
    }

    if(correcto){
        let options = {
            method: "POST",
            body: JSON.stringify({ codigo: codigoTarea, nombre: nombreTarea, descripcion: descripcionTarea }),
            headers: {
                'Content-Type': 'application/json'// AQUI indicamos el formato
            }
        };

        fetch("../php/actualizarTarea.php", options)
            .then(respuesta => respuesta.text())
            .then(texto => {
                traerTareas();
            });
        
    }
    
    
}