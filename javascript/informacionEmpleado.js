"use strict";

document.querySelector("#botonContraseña").addEventListener("click",mostrarContraseña);
document.querySelector("#botonEditar").addEventListener("click",permitirEdicion);
document.querySelector("#botonActualizar").addEventListener("click",actualizar);
document.querySelector("#botonModalCerrar").addEventListener("click",cerrar);


function mostrarContraseña(){
    let inputContra = document.querySelector("#inputPassword");
    let ojo = document.querySelector("#ojoContraseña");

    if(inputContra.type=="password"){
        inputContra.type = "text";
        ojo.classList.remove("fa-eye");
        ojo.classList.add("fa-eye-slash");
    } else {
        inputContra.type = "password";
        ojo.classList.remove("fa-eye-slash");
        ojo.classList.add("fa-eye");
    }
} 

function permitirEdicion(){
    document.querySelector("#inputNombre").disabled = false;
    document.querySelector("#inputTelefono").disabled = false;
    document.querySelector("#inputCorreo").disabled = false;
    document.querySelector("#inputPassword").disabled = false;
    document.querySelector("#botonActualizar").disabled = false;
}

function actualizar(){
    let nombreNuevo = document.querySelector("#inputNombre").value.trim();
    let telefonoNuevo = document.querySelector("#inputTelefono").value.trim();
    let correoNuevo = document.querySelector("#inputCorreo").value.trim();
    let passNuevo = document.querySelector("#inputPassword").value.trim();




    let oRegExp = /^[^0-9\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]{4,30}$/;
    let correcto = true;

    if(oRegExp.test(nombreNuevo)){
        document.querySelector("#inputNombre").classList.remove("is-invalid");
        document.querySelector("#inputNombre").classList.add("is-valid");
        if(document.querySelector("#liNombre") != undefined){
            document.querySelector("#liNombre").remove();
        }
        
    } else {
        document.querySelector("#inputNombre").classList.remove("is-valid");
        document.querySelector("#inputNombre").classList.add("is-invalid");
        if(document.querySelector("#liNombre") == undefined){
            document.querySelector("#listaValidacion").innerHTML = "<h5 id='liNombre'><strong>- El nombre no es correcto o está vacio.</strong></h5>";
        }
        
        correcto = false;        
    }

    oRegExp = /^\d{9}$/;

    if(oRegExp.test(telefonoNuevo)){
        document.querySelector("#inputTelefono").classList.remove("is-invalid");
        document.querySelector("#inputTelefono").classList.add("is-valid");
        if(document.querySelector("#liTelefono") != undefined){
            document.querySelector("#liTelefono").remove();
        }
        
    } else {
        document.querySelector("#inputTelefono").classList.remove("is-valid");
        document.querySelector("#inputTelefono").classList.add("is-invalid");
        if(document.querySelector("#liTelefono") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liTelefono'><strong>- El teléfono no es correcto o está vacio.</strong></h5>";
        }
        correcto = false;        
    }


    oRegExp = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;

    if(oRegExp.test(correoNuevo)){
        document.querySelector("#inputCorreo").classList.remove("is-invalid");
        document.querySelector("#inputCorreo").classList.add("is-valid");
        if(document.querySelector("#liCorreo") != undefined){
            document.querySelector("#liCorreo").remove();
        }
        
    } else {
        document.querySelector("#inputCorreo").classList.remove("is-valid");
        document.querySelector("#inputCorreo").classList.add("is-invalid");
        if(document.querySelector("#liCorreo") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liCorreo'><strong>- El correo no es correcto o está vacio.</strong></h5>";
        }
        
        correcto = false;        
    }

    oRegExp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;

    if(oRegExp.test(passNuevo)){
        document.querySelector("#inputPassword").classList.remove("is-invalid");
        document.querySelector("#inputPassword").classList.add("is-valid");
        if(document.querySelector("#liPassword") != undefined){
            document.querySelector("#liPassword").remove();
        }
        
    } else {
        document.querySelector("#inputPassword").classList.remove("is-valid");
        document.querySelector("#inputPassword").classList.add("is-invalid");
        if(document.querySelector("#liPassword") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liPassword'><strong>- La contraseña no es correcta o está vacia.</strong></h5>";

        }
        correcto = false;        
    }



    if(!correcto){
        modalValidacion.toggle();
    } else {
        let options = {
        method: "POST",
        body: JSON.stringify({ nombre: nombreNuevo, telefono: telefonoNuevo, correo: correoNuevo, pass: passNuevo}),
        headers: {
            'Content-Type': 'application/json'// AQUI indicamos el formato
        }
    };

    fetch("../php/actualizarEmpleado.php", options)
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

function cerrar(){
    document.querySelector("#inputNombre").disabled = true;
    document.querySelector("#inputTelefono").disabled = true;
    document.querySelector("#inputCorreo").disabled = true;
    document.querySelector("#inputPassword").disabled = true;
    document.querySelector("#botonActualizar").disabled = true;
}