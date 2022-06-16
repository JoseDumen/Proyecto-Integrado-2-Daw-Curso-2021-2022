"use strict";

listar();

function listar(){
    let options = {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        }
    };

    fetch("../php/listarEmpleados.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => responder(texto));
}

function responder(texto){
    document.querySelector("#listado").innerHTML = texto;
}

function cambiarEstado(id, evento){
    let oE = evento || window.event;

    let options = {
        method: "POST",
        body: JSON.stringify({ idEmpleado: id}),
        headers: {
            'Content-Type': 'application/json'// AQUI indicamos el formato
        }
    };

    fetch("../php/cambiarEstadoEmpleado.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => responderActualizacion(texto, oE));

}

function responderActualizacion(texto , oE){
    let boton = oE.target;
    if(texto == "D"){
        boton.classList.remove("btn-outline-danger");
        boton.classList.add("btn-outline-success");
        boton.value="Contratar";
    } else {
        boton.classList.remove("btn-outline-success");
        boton.classList.add("btn-outline-danger");
        boton.value="Despedir";
    }

    modalActualizacion.toggle();
    

}