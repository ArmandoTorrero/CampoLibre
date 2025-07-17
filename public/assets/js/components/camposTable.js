import { getCampos } from "./../services/campo.js";
import { crearElemento } from "./crearElemento.js";
import { crearTabla } from "./crearTabla.js";
import { iniciarTabla } from "./datatable.js";

export function camposTable() {

    const titulo = document.querySelector(".titulo"); 
    titulo.textContent = "Campos";

    getCampos().then(campos => {
        
        iniciarTabla("miTabla", campos)
        
    })
    
}