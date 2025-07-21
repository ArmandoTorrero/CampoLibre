import { tabla } from "./../controllers/adminController.js";
import { getCampos } from "./../services/campo.js";

export function camposTable() {

    const titulo = document.querySelector(".titulo"); 
    titulo.textContent = "Campos";

    const content = document.querySelector(".content .table"); 
    
    const table = tabla("campos")
    content.appendChild(table); 

    getCampos().then(campos => {
        
        const campos_obj = Object.values(campos).map(item => ({
            nombre: item.nombre,
            tipo: item.modalidad_id == 1 ? "Futbol" : item.modalidad_id == 2 ? "Tenis" : "Padel", 
            estado: item.disponible == 1 ? "Disponible" : "No disponible", 
            precio : `${item.precio_hora}€/hora`
        }))

        $("#campos").DataTable({
            destroy: true, 
            data: campos_obj,
            columns: [
                {title: "Nombre", data: "nombre"}, 
                {title: "Tipo", data: "tipo"}, 
                {title: "Estado", data: "estado"}, 
                {title: "Precio", data: "precio"}, 

            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' // Español
            }
        })
        
        
    })
    
}