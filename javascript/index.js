"use strict";

document.querySelector("#botonContraseña").addEventListener("click",mostrarContraseña);

function mostrarContraseña(){
    let inputContra = document.querySelector("#contraseña");
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

document.querySelector("#iniciarSesion").addEventListener("click", iniciarSesionUsuario);

function iniciarSesionUsuario(){
    let sCorreo = document.querySelector("#correo").value.trim();
    let sPassword = document.querySelector("#contraseña").value.trim();
    let options = {
        method: "POST",
        body: JSON.stringify({ correo: sCorreo, password: sPassword }),
        headers: {
            'Content-Type': 'application/json'// AQUI indicamos el formato
        }
    };

    fetch("./php/comprobarUsuario.php", options)
        .then(respuesta => respuesta.text())
        .then(texto => responder(texto));
}

function responder(texto){
    if(texto == "ok"){
        window.location = "pagina/inicio.php";
    } else {
        document.querySelector("#fallo").style.display="block";
    }
}