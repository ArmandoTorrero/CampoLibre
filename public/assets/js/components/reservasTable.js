import { getAll } from "./../services/reserva";
import { crearElemento } from "./crearElemento";
import { crearTabla } from "./crearTabla";

export function reservasTable() {
    
    const reservas_titulo_container = crearElemento("article","ultimas-reservas");   
    
        // const titulo = crearElemento("h1", "titulo"); 
        // titulo.textContent = "Ultimas reservas";
        
        // const reservas_container = crearElemento("article", "reservas"); 
        
        // getAll().then(reservas => {
            
        //     let headers = ['Usuario', 'Campo', 'Fecha', 'Precio']; 
        //     let data = reservas.reservas.map(reserva => {
        
        //         return [
        //             reserva.nombre, 
        //             reserva.nombre_pista, 
        //             `${reserva.fecha} ${reserva.hora_inicio.slice(0,5)}`, 
        //             `${reserva.precio_hora}€`
        //         ]
        //     })
    
        //     reservas_container.appendChild(crearTabla(headers, data));
        
        //     reservas_titulo_container.append(titulo,reservas_container); 
        // })
    
        
        return reservas_titulo_container; 
}