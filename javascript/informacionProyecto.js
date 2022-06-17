"use strict";

traerActividades();

document.querySelector("#botonEditarProyecto").addEventListener("click", editar);
document.querySelector("#botonActualizarProyecto").addEventListener("click", actualizar);
document.querySelector("#botonModalCerrar").addEventListener("click",cerrar);
document.querySelector("#botonAltaActividad").addEventListener("click",mostrar);
document.querySelector("#altaActividad").addEventListener("click", altaActividad);
document.querySelector("#cerrarModalAlta").addEventListener("click", vaciarModalActividad);
document.querySelector("#modificarActividad").addEventListener("click", actualizarActividad);
document.querySelector("#cerrarModalActualizacion").addEventListener("click", cerrarModalActualizacion);
document.querySelector("#inputTareasActividadParte").addEventListener("change", mostrarTarea);
document.querySelector("#botonAñadirParte").addEventListener("click",crearParteTrabajo);

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
    let idProyecto = document.querySelector("#idProyecto").value.trim();
    let nombreActiivdad = document.querySelector("#inputNombreActiivdad").value.trim();
    let horasActiivdad = parseInt(document.querySelector("#inputHorasActividad").value.trim());
    let fechaIActiivdad = document.querySelector("#inputFechaInicioActividad").value.trim();
    let fechaFActividad = document.querySelector("#inputFechaFinActividad").value.trim();
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


    if (fechaFActividad != "") {
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
            body: JSON.stringify({ id: idProyecto, nombre: nombreActiivdad, horas:horasActiivdad , fechaI: fechaIActiivdad, fechaF: fechaFActividad, descripcion: descripcionActiivdad }),
            headers: {
                'Content-Type': 'application/json'// AQUI indicamos el formato
            }
        };

        fetch("../php/darAltaActividad.php", options)
            .then(respuesta => respuesta.text())
            .then(texto => responderAltaActividad(texto));
    }


}

function responderAltaActividad(texto) {

    traerActividades();

}


function traerActividades(){
    let idProyecto = document.querySelector("#idProyecto").value.trim();
    let options = {
        method: "POST",
        body: JSON.stringify({ id: idProyecto}),
        headers: {
            'Content-Type': 'application/json'
        }
    };

    fetch("../php/traerActividades.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => responderTraerActividades(texto));
}

function responderTraerActividades(texto) {
    let cuerpoTabla = document.querySelector("#cuerpoActividades");

    for(let i = 0; i< cuerpoTabla.children.length;i++){
        cuerpoTabla.children[i].remove();
    }

    cuerpoTabla.innerHTML = texto;

}


function modificar(id) {
    let options = {
        method: "POST",
        body: JSON.stringify({ idActividad: id}),
        headers: {
            'Content-Type': 'application/json'
        }
    };

    fetch("../php/traerActividad.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => {

        let datos = texto.split(",");

            document.querySelector("#inputNombreActiivdadActualizar").value = datos[1];
            document.querySelector("#inputHorasActividadActualizar").value = datos[4];
            
            let fechaI = datos[5].split("-");
            let fechaIMostrar = fechaI[2]+"/"+fechaI[1]+"/"+fechaI[0];
            document.querySelector("#inputFechaInicioActividadActualizar").value = fechaIMostrar;
            
            let fechaF = datos[6].split("-");
            let fechaFMostrar = fechaF[2]+"/"+fechaF[1]+"/"+fechaF[0];
            document.querySelector("#inputFechaFinActividadActualizar").value = fechaFMostrar;
            
            document.querySelector("#inputDescripcionActividadActualizar").innerHTML = datos[3];
            document.querySelector("#inputDescripcionActividadActualizar").value = datos[3];
            document.querySelector("#idModificarActividad").value = datos[0];

            modalModificarActividad.toggle();



        });
}

function actualizarActividad() {

    let idActividad = document.querySelector("#idModificarActividad").value.trim();
    let nombreActiivdad = document.querySelector("#inputNombreActiivdadActualizar").value.trim();
    let horasActiivdad = parseInt(document.querySelector("#inputHorasActividadActualizar").value.trim());
    let fechaIActiivdad = document.querySelector("#inputFechaInicioActividadActualizar").value.trim();
    let fechaFActividad = document.querySelector("#inputFechaFinActividadActualizar").value.trim();
    let descripcionActiivdad = document.querySelector("#inputDescripcionActividadActualizar").value.trim();

    let correcto = true;

    if (nombreActiivdad != "") {
        document.querySelector("#inputNombreActiivdadActualizar").classList.remove("is-invalid");
        document.querySelector("#inputNombreActiivdadActualizar").classList.add("is-valid");

    } else {
        document.querySelector("#inputNombreActiivdadActualizar").classList.remove("is-valid");
        document.querySelector("#inputNombreActiivdadActualizar").classList.add("is-invalid");

        correcto = false;
    }

    if (!isNaN(horasActiivdad)) {
        document.querySelector("#inputHorasActividadActualizar").classList.remove("is-invalid");
        document.querySelector("#inputHorasActividadActualizar").classList.add("is-valid");


    } else {
        document.querySelector("#inputHorasActividadActualizar").classList.remove("is-valid");
        document.querySelector("#inputHorasActividadActualizar").classList.add("is-invalid");

        correcto = false;
    }

    if (descripcionActiivdad != "") {
        document.querySelector("#inputDescripcionActividadActualizar").classList.remove("is-invalid");
        document.querySelector("#inputDescripcionActividadActualizar").classList.add("is-valid");


    } else {
        document.querySelector("#inputDescripcionActividadActualizar").classList.remove("is-valid");
        document.querySelector("#inputDescripcionActividadActualizar").classList.add("is-invalid");

        correcto = false;
    }

    if (fechaIActiivdad != "") {
        document.querySelector("#inputFechaInicioActividadActualizar").classList.remove("is-invalid");
        document.querySelector("#inputFechaInicioActividadActualizar").classList.add("is-valid");

    } else {
        document.querySelector("#inputFechaInicioActividadActualizar").classList.remove("is-valid");
        document.querySelector("#inputFechaInicioActividadActualizar").classList.add("is-invalid");

        correcto = false;
    }


    if (fechaFActividad != "") {
        document.querySelector("#inputFechaFinActividadActualizar").classList.remove("is-invalid");
        document.querySelector("#inputFechaFinActividadActualizar").classList.add("is-valid");

    } else {
        document.querySelector("#inputFechaFinActividadActualizar").classList.remove("is-valid");
        document.querySelector("#inputFechaFinActividadActualizar").classList.add("is-invalid");

        correcto = false;
    }

    if(correcto){

        let options = {
            method: "POST",
            body: JSON.stringify({ id: idActividad, nombre: nombreActiivdad, horas:horasActiivdad , fechaI: fechaIActiivdad, fechaF: fechaFActividad, descripcion: descripcionActiivdad }),
            headers: {
                'Content-Type': 'application/json'// AQUI indicamos el formato
            }
        };

        fetch("../php/actualizarActividad.php", options)
            .then(respuesta => respuesta.text())
            .then(texto => {
                traerActividades();
            });
    }


}

function cerrarModalActualizacion() {
    document.querySelector("#idModificarActividad").value = "";
    document.querySelector("#inputNombreActiivdadActualizar").value = "";
    document.querySelector("#inputHorasActividadActualizar").value = "";
    document.querySelector("#inputFechaInicioActividadActualizar").value = "";
    document.querySelector("#inputFechaFinActividadActualizar").value = "";
    document.querySelector("#inputDescripcionActividadActualizar").innerHTML = "";
    document.querySelector("#inputDescripcionActividadActualizar").value = "";



    document.querySelector("#inputNombreActiivdadActualizar").classList.remove("is-invalid");
    document.querySelector("#inputNombreActiivdadActualizar").classList.remove("is-valid");

    document.querySelector("#inputHorasActividadActualizar").classList.remove("is-invalid");
    document.querySelector("#inputHorasActividadActualizar").classList.remove("is-valid");

    document.querySelector("#inputDescripcionActividadActualizar").classList.remove("is-invalid");
    document.querySelector("#inputDescripcionActividadActualizar").classList.remove("is-valid");

    document.querySelector("#inputFechaInicioActividadActualizar").classList.remove("is-invalid");
    document.querySelector("#inputFechaInicioActividadActualizar").classList.remove("is-valid");

    document.querySelector("#inputFechaFinActividadActualizar").classList.remove("is-invalid");
    document.querySelector("#inputFechaFinActividadActualizar").classList.remove("is-valid");
}

function eliminar(id) {
    let idActividad = id;
    let options = {
        method: "POST",
        body: JSON.stringify({ id: idActividad }),
        headers: {
            'Content-Type': 'application/json'// AQUI indicamos el formato
        }
    };

    fetch("../php/eliminarActividad.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => {
            modalEliminarActividad.toggle();
            traerActividades();
        });
}

function añadirTarea(id, evento) {
    let oE = evento || window.event;
    modalParteTrabajo.toggle();
    let nombreActiivdad = oE.target.parentElement.parentElement.children[0].innerHTML
    
    document.querySelector("#idActividadParte").value=id;
    document.querySelector("#inputNombreActividadParte").value=nombreActiivdad;
    
    document.querySelector("#inputTareasActividadParte").selectedIndex = 0;
    document.querySelector("#inputNombreTareaActividad").value = "";
    document.querySelector("#inputDescripcionTareaParte").value ="";
    document.querySelector("#inputDescripcionTareaParte").innerHTML ="";



    document.querySelector("#inputHorasActividadParte").classList.remove("is-invalid");
    document.querySelector("#inputHorasActividadParte").classList.remove("is-valid");
    document.querySelector("#inputTareasActividadParte").classList.remove("is-invalid");
    document.querySelector("#inputTareasActividadParte").classList.remove("is-valid");
    
}

ponerFechaInicio();

function ponerFechaInicio(){
    let fecha = new Date();
let dia = fecha.getDate();
let mes = fecha.getMonth() + 1;
let anno = fecha.getFullYear();

document.querySelector("#inputFechaActividadParte").value = dia+"/"+mes+"/"+anno;

}

function mostrarTarea(evento) {
    let oE = evento || window.event;
    let codigoTraer = oE.target.value;

    let options = {
        method: "POST",
        body: JSON.stringify({ codigo: codigoTraer }),
        headers: {
            'Content-Type': 'application/json'// AQUI indicamos el formato
        }
    };

    fetch("../php/traerNombreDescripcionTarea.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => {
            let valores = texto.split(",");
            document.querySelector("#inputNombreTareaActividad").value = valores[0];
            document.querySelector("#inputDescripcionTareaParte").value = valores[1];
            document.querySelector("#inputDescripcionTareaParte").innerHTML = valores[1];
            
        });
    
}

function crearParteTrabajo() {
    let idActividad = document.querySelector("#idActividadParte").value.trim();
    let idCodigoTarea = document.querySelector("#inputTareasActividadParte").value.trim();
    let fechaParte = document.querySelector("#inputFechaActividadParte").value.trim();
    let horasParte = parseInt(document.querySelector("#inputHorasActividadParte").value.trim());

    let correcto = true;

    if (!isNaN(horasParte)) {
        document.querySelector("#inputHorasActividadParte").classList.remove("is-invalid");
        document.querySelector("#inputHorasActividadParte").classList.add("is-valid");


    } else {
        document.querySelector("#inputHorasActividadParte").classList.remove("is-valid");
        document.querySelector("#inputHorasActividadParte").classList.add("is-invalid");

        correcto = false;
    }

    if (idCodigoTarea != "no") {
        document.querySelector("#inputTareasActividadParte").classList.remove("is-invalid");
        document.querySelector("#inputTareasActividadParte").classList.add("is-valid");


    } else {
        document.querySelector("#inputTareasActividadParte").classList.remove("is-valid");
        document.querySelector("#inputTareasActividadParte").classList.add("is-invalid");

        correcto = false;
    }

    if(correcto){

        let options = {
            method: "POST",
            body: JSON.stringify({id:idActividad, codigo:idCodigoTarea, fecha:fechaParte, horas:horasParte }),
            headers: {
                'Content-Type': 'application/json'
            }
        };

        fetch("../php/crearParteTrabajo.php", options)
            .then(respuesta => respuesta.text())
            .then(texto => {
                traerActividades();
            });
    }
    
}