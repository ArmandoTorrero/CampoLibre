import { validarForm } from "./../components/validarForm.js";
import { setCookie } from "./../components/cookies.js";
import { initForm } from "./../components/initForm.js";
import { mostrarPasswd } from "./loginController.js";


export function aceptarTerminos() {
    const checkbox = document.getElementById("terminos-condiciones"); 
    setCookie("terminosCondiciones", checkbox.checked);    
}

export function initRegistro() {

    const inputs = [...document.querySelectorAll('.label-input')].map(label => label.querySelector('input'));
    const spans = [...document.querySelectorAll(".label-input span")]; 
    const buttonSubmit = document.querySelector(".enviar"); 

    validarForm(
        inputs, 
        spans, 
        [
            /^[a-zA-Z0-9]{3,15}$/, 
            /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/, 
            /^.{5,}$/, 
            /^\d{9}$/
        ], 
        buttonSubmit
    )

    mostrarPasswd(); 

    const form = document.querySelector("form");     

    form.addEventListener("submit", async (ev) => {
        ev.preventDefault(); 

        initForm(form, '/validarRegistro')
        aceptarTerminos();   
        
    })
}

