import { validarForm } from "./../components/validarForm";
import { initForm } from "./../components/initForm";
import { aceptarTerminos } from "./../controllers/registroController";


document.addEventListener("DOMContentLoaded", () => {
      
    const inputs = [...document.querySelectorAll(".label-input input")];  
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
    

    const form = document.querySelector("form");     

    form.addEventListener("submit", async (ev) => {
        ev.preventDefault(); 

        initForm(form, '/validarRegistro')
        aceptarTerminos();   
        
    })

}) 