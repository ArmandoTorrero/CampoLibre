import { getCampos } from "./../services/campo.js";
import { crearElemento } from "./crearElemento.js";
import { crearTabla } from "./crearTabla.js";

export function camposTable() {
    
    const campos_titulo_container = crearElemento("article", "campos-container");
    
    const titulo = crearElemento("h1", "titulo"); 
    titulo.textContent = "Campos deportivos";
    
    const campos_container = crearElemento("article", "campos"); 
    
    let headers = ['Nombre', 'Tipo', 'Estado', 'Precio']; 
    campos_container.appendChild(crearTabla(headers,[]))

    let table = campos_container.querySelector("table"); 
    

    campos_titulo_container.append(titulo,campos_container); 

    return campos_titulo_container; 
}