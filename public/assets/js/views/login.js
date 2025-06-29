import { initForm, validarForm } from "../controllers/loginController"

document.addEventListener("DOMContentLoaded", () =>{

    validarForm(); 
    
    const form = document.querySelector("form");     

    form.addEventListener("submit", async (ev) => {
        ev.preventDefault(); 

        initForm(form, "/validarLogin"); 
    })
})