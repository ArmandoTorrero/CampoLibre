import { tabla } from "./../controllers/adminController";
import { getAll } from "./../services/reserva";


export async function reservasTable() {
    
    const titulo = document.querySelector(".titulo"); 
    titulo.textContent = "Reservas";

    const content = document.querySelector(".content .table"); 
        
    const table = tabla("reservas"); 
    content.appendChild(table);
    
    const { reservas } = await getAll();
    
    const reservas_obj = Object.values(reservas).map(item => ({
        nombre: item.nombre, 
        pista: item.nombre_pista,
        fecha: item.fecha,
        hora: item.hora_inicio.slice(0,5)
    }))        
    
    $("#reservas").DataTable({
        destroy: true,
        data: reservas_obj,
        responsive: true,
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
        
}