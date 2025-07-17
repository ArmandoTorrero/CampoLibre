import { getUsuarios } from "./../services/user.js";
import { iniciarTabla } from "./datatable.js";


export function usuariosTable() {

    const titulo = document.querySelector(".titulo"); 
    titulo.textContent = "Usuarios";
    
    getUsuarios().then(users => {
        
        iniciarTabla("miTabla",users.usuarios)
        
    })
}