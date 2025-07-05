import { crearElemento } from "./crearElemento";


export function reservasContainer(array_reservas) {
    
    const container = crearElemento("section", "reservas_container"); 
    const titulo = crearElemento("h1", "mis-reservas-title")
    titulo.textContent = "Mis reservas"; 
    
    

    const reservas = array_reservas.map(reserva => {

        const info_reserva = crearElemento("section", "info-reserva"); 

        const titulo_fecha = crearElemento("article", "titulo-fecha"); 
        const nombre_campo = crearElemento("h2", "nombre_campo"); 
        nombre_campo.textContent = reserva.nombre_pista; 
        const fecha_hora = crearElemento("span", "fecha-hora")
        fecha_hora.textContent = `${reserva.fecha} ${reserva.hora_inicio.slice(0,5)}`
        
        titulo_fecha.append(nombre_campo,fecha_hora)


        const status_reserva_precio = crearElemento("article", "add_info"); 
        const status_reserva = crearElemento("span", "status"); 
        status_reserva.textContent = "Completada"; 
        const precio = crearElemento("span", "precio-reserva"); 
        precio.textContent = `${reserva.precio_hora.slice(0,2)}€`
        
        status_reserva_precio.append(status_reserva,precio); 


        info_reserva.appendChild(titulo_fecha)
        info_reserva.appendChild(status_reserva_precio)


        return info_reserva; 
    })


    container.appendChild(titulo); 
    reservas.forEach(info_reserva => container.appendChild(info_reserva))

    return container; 
}