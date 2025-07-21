
import { tabla } from "./../controllers/adminController.js";
import { getAll } from "./../services/reserva.js";

/**
 * Sección de últimas reservas
 * @returns 
 */
export function ultimasReservas() {

    const titulo = document.querySelector(".titulo"); 
    titulo.textContent = "Ultimas reservas";

    const content = document.querySelector(".content .table"); 
    
    const table = tabla("ultimasReservas")
    content.appendChild(table); 
    
    getAll().then(result => {
        
        const { reservas } = result; 
        
        const reservas_obj = Object.values(reservas).map(item => ({
            nombre: item.nombre, 
            pista: item.nombre_pista,
            fecha: item.fecha,
            hora: item.hora_inicio.slice(0,5)
        }))        
        
        $("#ultimasReservas").DataTable({
            destroy: true,
             data: reservas_obj.slice(-5),
                columns: [
                    { title: "Usuario", data: "nombre" },
                    { title: "Pista", data: "pista" },
                    { title: "Fecha", data: "fecha" }, 
                    { title: "Hora", data: "hora" }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' // Español
                }
        })        
        
    })    
}



