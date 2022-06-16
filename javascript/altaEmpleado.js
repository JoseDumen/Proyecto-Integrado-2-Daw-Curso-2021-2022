"use strict";

document.querySelector("#botonAlta").addEventListener("click", alta);
document.querySelector("#botonContraseña").addEventListener("click",mostrarContraseña);

function alta(){
    let nombreEmpleado = document.querySelector("#inputNombre").value.trim();
    let telefonoEmpleado = document.querySelector("#inputTelefono").value.trim();
    let correoEmpleado = document.querySelector("#inputCorreo").value.trim();
    let passwordEmpleado = document.querySelector("#inputPassword").value.trim();
    let categoriaEmpleado = document.querySelector("#selectCategoria").value;


    let oRegExp = /^[^0-9\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]{4,30}$/;
    let correcto = true;

    if(oRegExp.test(nombreEmpleado)){
        document.querySelector("#inputNombre").classList.remove("is-invalid");
        document.querySelector("#inputNombre").classList.add("is-valid");
        if(document.querySelector("#liNombre") != undefined){
            document.querySelector("#liNombre").remove();
        }
        
    } else {
        document.querySelector("#inputNombre").classList.remove("is-valid");
        document.querySelector("#inputNombre").classList.add("is-invalid");
        if(document.querySelector("#liNombre") == undefined){
            document.querySelector("#listaValidacion").innerHTML = "<h5 id='liNombre'><strong>- El nombre no es correcto o está vacío.</strong></h5>";
        }
        
        correcto = false;        
    }

    oRegExp = /^\d{9}$/;

    if(oRegExp.test(telefonoEmpleado)){
        document.querySelector("#inputTelefono").classList.remove("is-invalid");
        document.querySelector("#inputTelefono").classList.add("is-valid");
        if(document.querySelector("#liTelefono") != undefined){
            document.querySelector("#liTelefono").remove();
        }
        
    } else {
        document.querySelector("#inputTelefono").classList.remove("is-valid");
        document.querySelector("#inputTelefono").classList.add("is-invalid");
        if(document.querySelector("#liTelefono") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liTelefono'><strong>- El teléfono no es correcto o está vacío.</strong></h5>";
        }
        correcto = false;        
    }


    oRegExp = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;

    if(oRegExp.test(correoEmpleado)){
        document.querySelector("#inputCorreo").classList.remove("is-invalid");
        document.querySelector("#inputCorreo").classList.add("is-valid");
        if(document.querySelector("#liCorreo") != undefined){
            document.querySelector("#liCorreo").remove();
        }
        
    } else {
        document.querySelector("#inputCorreo").classList.remove("is-valid");
        document.querySelector("#inputCorreo").classList.add("is-invalid");
        if(document.querySelector("#liCorreo") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liCorreo'><strong>- El correo no es correcto o está vacío.</strong></h5>";
        }
        
        correcto = false;        
    }

    oRegExp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;

    if(oRegExp.test(passwordEmpleado)){
        document.querySelector("#inputPassword").classList.remove("is-invalid");
        document.querySelector("#inputPassword").classList.add("is-valid");
        if(document.querySelector("#liPassword") != undefined){
            document.querySelector("#liPassword").remove();
        }
        
    } else {
        document.querySelector("#inputPassword").classList.remove("is-valid");
        document.querySelector("#inputPassword").classList.add("is-invalid");
        if(document.querySelector("#liPassword") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liPassword'><strong>- La contraseña no es correcta o está vacía.</strong></h5>";

        }
        correcto = false;        
    }


    if(categoriaEmpleado != "sin"){
        document.querySelector("#selectCategoria").classList.remove("is-invalid");
        document.querySelector("#selectCategoria").classList.add("is-valid");
        if(document.querySelector("#liCategoria") != undefined){
            document.querySelector("#liCategoria").remove();
        }
    } else {
        document.querySelector("#selectCategoria").classList.remove("is-valid");
        document.querySelector("#selectCategoria").classList.add("is-invalid");
        if(document.querySelector("#liCategoria") == undefined){
            document.querySelector("#listaValidacion").innerHTML += "<h5 id='liCategoria'><strong>- Debe seleccionar una categoría.</strong></h5>";
        }
       
        correcto = false;  
    }

    
    if(!correcto){
        modalValidacion.toggle();
    } else {
        let options = {
            method: "POST",
            body: JSON.stringify({ nombre: nombreEmpleado, telefono: telefonoEmpleado, correo: correoEmpleado, pass: passwordEmpleado, categoria: categoriaEmpleado }),
            headers: {
                'Content-Type': 'application/json'// AQUI indicamos el formato
            }
        };
    
        fetch("../php/darAltaEmpleado.php", options)
            .then(respuesta => respuesta.text())
            .then(texto => responder(texto));

    }
    
}

function responder(texto){
    switch (texto) {
        case "existe":
            modalExiste.toggle();
            break;

        case "ok":
            modalAlta.toggle();

            break;

        case "ko":
            modalAltaErronea.toggle();

            break;    
    }
}





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