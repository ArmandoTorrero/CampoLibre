import { validarForm } from "./../components/validarForm";
import { initForm } from "./../components/initForm";
import { comprobarCookieRecuerdame, isCheked, mostrarPasswd } from "./../controllers/loginController"


document.addEventListener("DOMContentLoaded", () =>{


    const inputs = [...document.querySelectorAll(".label-input > input")];  
    
    const spans = [...document.querySelectorAll(".label-input > span")]; 
    const buttonSubmit = document.querySelector(".enviar"); 

    validarForm(
        inputs, 
        spans, 
        [
            /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/, 
            /^.{5,}$/
        ], 
        buttonSubmit
    )
    
    const form = document.querySelector("form");     

    form.addEventListener("submit", async (ev) => {
        ev.preventDefault(); 

        initForm(form, "/validarLogin"); 
        isCheked(); 
    })

    comprobarCookieRecuerdame(); 
    mostrarPasswd(); 
})