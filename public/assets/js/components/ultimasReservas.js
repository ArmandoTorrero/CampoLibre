
import { crearElemento } from "./crearElemento.js";
import { getAll } from "./../services/reserva.js";
import { iniciarTablaReservas } from "./datatable.js";

/**
 * Sección de últimas reservas
 * @returns 
 */
export function ultimasReservas() {
    
    const titulo = document.querySelector(".titulo"); 
    titulo.textContent = "Ultimas reservas";

    
    getAll().then(reservas => {
        
        
        let ultimas = reservas.reservas.slice(-5)
        iniciarTablaReservas("miTabla", ultimas)
        
    })    
}



