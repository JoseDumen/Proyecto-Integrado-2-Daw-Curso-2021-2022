"use strict";

document.querySelector("#inputTareasActividadParte").addEventListener("change", mostrarTarea);
document.querySelector("#botonModificarParte").addEventListener("click", actualizarParte);

traerPartes();

function traerPartes() {
    let options = {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        }
    };

    fetch("../php/traerPartes.php", options)
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
            traerPartes();
        });
}

function modificar(id, evento) {
    let oE = evento || window.event;

    document.querySelector("#idParteTrabajo").value = id;

    let codigoTarea = oE.target.parentElement.parentElement.children[1].innerHTML;

    let optionsSelect =document.querySelector("#inputTareasActividadParte").options;

    for(let i = 0 ; i< optionsSelect.length;i++){
        if(optionsSelect[i].value == codigoTarea){
            optionsSelect[i].selected = true
        }
    }

    let options = {
        method: "POST",
        body: JSON.stringify({ codigo: codigoTarea}),
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


    document.querySelector("#inputFechaActividadParte").value = oE.target.parentElement.parentElement.children[6].innerHTML;
    document.querySelector("#inputHorasActividadParte").value = oE.target.parentElement.parentElement.children[7].innerHTML;

    document.querySelector("#inputNombreActividadParte").classList.remove("is-invalid");
    document.querySelector("#inputNombreActividadParte").classList.remove("is-valid");
    document.querySelector("#inputHorasActividadParte").classList.remove("is-invalid");
    document.querySelector("#inputHorasActividadParte").classList.remove("is-valid");
    document.querySelector("#inputTareasActividadParte").classList.remove("is-invalid");
    document.querySelector("#inputTareasActividadParte").classList.remove("is-valid");
    document.querySelector("#inputFechaActividadParte").classList.remove("is-invalid");
    document.querySelector("#inputFechaActividadParte").classList.remove("is-valid");


    modalParteTrabajo.toggle();

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

function actualizarParte(codigo) {
    let selectNombreActividad = document.querySelector("#inputNombreActividadParte").value.trim();
    let fechaParte = document.querySelector("#inputFechaActividadParte").value.trim();
    let inputHorasParte = document.querySelector("#inputHorasActividadParte").value.trim();
    let selectTareasActividad = document.querySelector("#inputTareasActividadParte").value.trim();
    let idParte = document.querySelector("#idParteTrabajo").value;

    let correcto = true;

    if (selectNombreActividad != "no") {
        document.querySelector("#inputNombreActividadParte").classList.remove("is-invalid");
        document.querySelector("#inputNombreActividadParte").classList.add("is-valid");

    } else {
        document.querySelector("#inputNombreActividadParte").classList.remove("is-valid");
        document.querySelector("#inputNombreActividadParte").classList.add("is-invalid");

        correcto = false;
    }

    if (!isNaN(inputHorasParte) || inputHorasParte === "" ) {
        document.querySelector("#inputHorasActividadParte").classList.remove("is-invalid");
        document.querySelector("#inputHorasActividadParte").classList.add("is-valid");


    } else {
        document.querySelector("#inputHorasActividadParte").classList.remove("is-valid");
        document.querySelector("#inputHorasActividadParte").classList.add("is-invalid");

        correcto = false;
    }

    if (selectTareasActividad != "no") {
        document.querySelector("#inputTareasActividadParte").classList.remove("is-invalid");
        document.querySelector("#inputTareasActividadParte").classList.add("is-valid");


    } else {
        document.querySelector("#inputTareasActividadParte").classList.remove("is-valid");
        document.querySelector("#inputTareasActividadParte").classList.add("is-invalid");

        correcto = false;
    }

    if (fechaParte != "") {
        document.querySelector("#inputFechaActividadParte").classList.remove("is-invalid");
        document.querySelector("#inputFechaActividadParte").classList.add("is-valid");


    } else {
        document.querySelector("#inputFechaActividadParte").classList.remove("is-valid");
        document.querySelector("#inputFechaActividadParte").classList.add("is-invalid");

        correcto = false;
    }

    if(correcto){

        let selectNombreActividad = document.querySelector("#inputNombreActividadParte").value.trim();
        let fechaParte = document.querySelector("#inputFechaActividadParte").value.trim();
        let inputHorasParte = document.querySelector("#inputHorasActividadParte").value.trim();
        let selectTareasActividad = document.querySelector("#inputTareasActividadParte").value.trim();
        idParte


        let options = {
            method: "POST",
            body: JSON.stringify({ id: idParte, idActividad: selectNombreActividad, horas:inputHorasParte , fecha: fechaParte, codigoTarea: selectTareasActividad}),
            headers: {
                'Content-Type': 'application/json'// AQUI indicamos el formato
            }
        };

        fetch("../php/actualizarParteTrabajo.php", options)
            .then(respuesta => respuesta.text())
            .then(texto => {
                traerPartes();
            });
    }
}

function eliminar(id) {
    let options = {
        method: "POST",
        body: JSON.stringify({ idEliminar: id}),
        headers: {
            'Content-Type': 'application/json'// AQUI indicamos el formato
        }
    };

    fetch("../php/eliminarParteTrabajo.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => {
            modalEliminar.toggle();
            traerPartes();
        });

    
}