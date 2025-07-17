import { getAll } from "./../services/reserva";
import { iniciarTabla } from "./datatable";


export function reservasTable() {
    
    const titulo = document.querySelector(".titulo"); 
    titulo.textContent = "Reservas";
    
        getAll().then(reservas => {            
            
            iniciarTabla("miTabla", reservas.reservas)
            
        }) 
        
}