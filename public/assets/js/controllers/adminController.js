import { camposTable } from "./../components/camposTable.js";
import { buttonSelected } from "./../components/buttonSelected.js";
import { ultimasReservas } from "./../components/ultimasReservas.js";
import { cerrarSesion } from "./perfilController.js";
import { reservasTable } from "./../components/reservasTable.js";
import { usuariosTable } from "./../components/usuariosTable.js";

/**
 * Función que contiene toda la lógica de la vista de administrador
 */
export function initPerfilAdmin() {

    
    const buttons = [...document.querySelectorAll(".buttons button")]; 
    buttonSelected(buttons, "selected"); 
    accionarBotones();  
    ultimasReservas();
    cerrarSesion();
}



function accionarBotones() {
    
    const buttons = [...document.querySelectorAll(".buttons button")];
    clearTable(buttons[0], () => console.log("boton 1"))
    clearTable(buttons[1], () => console.log("boton 2"))
    clearTable(buttons[2], () => console.log("boton 3"))
    clearTable(buttons[3], () => console.log("boton 4"))

    

}

function clearTable(btn,callback) {
    
    btn.addEventListener("click", () => {
        callback(); 
    })

}



