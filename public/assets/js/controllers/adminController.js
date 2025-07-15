import { camposTable } from "./../components/camposTable.js";
import { buttonSelected } from "./../components/buttonSelected.js";
import { ultimasReservas } from "./../components/ultimasReservas.js";
import { cerrarSesion, clearContent } from "./perfilController.js";

/**
 * Función que contiene toda la lógica de la vista de administrador
 */
export function initPerfilAdmin() {

    ultimasReservas();

    const buttons = [...document.querySelectorAll(".buttons button")]; 
    buttonSelected(buttons, "selected"); 

    accionarBotones();  
    cerrarSesion();
}



function accionarBotones() {
    
    const buttons = [...document.querySelectorAll(".buttons button")];
  

}



