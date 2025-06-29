import { initForm, validarForm } from "./../controllers/registroController";


document.addEventListener("DOMContentLoaded", () => {
      
    validarForm(); 
    
    const form = document.querySelector("form");     

    form.addEventListener("submit", async (ev) => {
        ev.preventDefault(); 

        initForm(form, "/validarRegistro"); 
    })

}) 