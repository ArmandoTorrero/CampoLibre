import { tabla } from "./../controllers/adminController.js";
import { getUsuarios } from "./../services/user.js";


export function usuariosTable() {

    const titulo = document.querySelector(".titulo"); 
    titulo.textContent = "Usuarios";

    const content = document.querySelector(".content .table"); 
    content.innerHTML = ""; 

    const table = tabla("usuarios"); 
    content.appendChild(table); 
    
    getUsuarios().then(result => {
        
        const { usuarios } = result; 
        
        const usuarios_obj = Object.values(usuarios).map(item => ({
            nombre: item.nombre, 
            email: item.email, 
            tlf: item.tlf
        }))
        
        $("#usuarios").DataTable({
            destroy:true, 
            data: usuarios_obj, 
            columns: [
                { title: "Nombre", data: "nombre"},
                { title: "Correo", data: "email"},
                { title: "Teléfono", data: "tlf"}

            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' // Español
            }
        })

    }).catch(error => {
        console.error("Error cargando usuarios:", error);
        
    })
    
}