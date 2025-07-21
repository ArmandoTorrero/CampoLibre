import { validarForm } from "./../components/validarForm";
import { calendar } from "./../components/calendarComponent";
import { addDataForm, infoCampo, initReserva, rellenarInfoReserva } from "./../controllers/reservarCampoController"
import { initForm } from "./../components/initForm";
import { logueado } from "../services/user";
import { BASE_URL } from "../config/config";


document.addEventListener("DOMContentLoaded", () => {

    infoCampo(); 
 
    const calendario = document.getElementById("fecha"); 
    const inputs = [...document.querySelectorAll(".label-input input")];  
    const spans = [...document.querySelectorAll(".label-input span")]
    const buttonSubmit = document.querySelector("button.confirm-pay"); 
    
    const form = document.querySelector("dialog form");  
    form.method = "POST";

    calendar(calendario); 
    initReserva(calendario); 
    validarForm(
        inputs,
        spans, 
        [
            /^[A-ZÁÉÍÓÚÑ][A-ZÁÉÍÓÚÑ\s]{2,50}$/i,
            /^\d{4} ?\d{4} ?\d{4} ?\d{1,7}$/,
            /^(0[1-9]|1[0-2])\/(\d{2})$/,
            /^\d{3}$/
        ] 
        ,buttonSubmit
    ); 
    rellenarInfoReserva(); 

    form.addEventListener("submit", async (ev) => {
        ev.preventDefault(); 
        
        const dialog = form.closest("dialog");
        if (dialog) dialog.close();

        addDataForm(); 
        initForm(form, "/validarReserva"); 
    })

})