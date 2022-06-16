"use strict";

listar();

function listar(){
    let options = {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        }
    };

    fetch("../php/listarProyectos.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => responder(texto));
}

function responder(texto){
    document.querySelector("#listado").innerHTML = texto;
}

function ver(id){
    window.location = "informacionProyecto.php?id="+id;
}