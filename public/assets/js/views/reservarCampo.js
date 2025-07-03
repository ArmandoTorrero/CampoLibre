import { validarForm } from "./../components/validarForm";
import { calendar } from "./../components/calendarComponent";
import { infoCampo, initReserva, rellenarInfoReserva } from "./../controllers/reservarCampoController"
import { initForm } from "./../components/initForm";


document.addEventListener("DOMContentLoaded", () => {

    infoCampo(); 
 
    const calendario = document.getElementById("fecha"); 
    const inputs = [...document.querySelectorAll(".label-input input")];  
    const spans = [...document.querySelectorAll(".label-input span")]
    const buttonSubmit = document.querySelector("button.confirm-pay"); 
    
    const form = document.querySelector("dialog form");    

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

        initForm(form, "/validarReserva"); 
    })

})