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
        document.querySelector("#listaValidacion").innerHTML = "<h5 id='liNombre'><strong>- El nombre no es correcto</strong></h5>";
        correcto = false;        
    }

    oRegExp = /^\d{0,9}$/;

    
    if(!correcto){
        modalAlta.toggle();
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