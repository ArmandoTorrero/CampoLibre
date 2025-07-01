import { getCampoById } from "./../services/campo.js";


export function infoCampo() {

    const titulo_precio = document.querySelector("article.titulo-precio"); 
    const categoria = document.querySelector("article.categoria > p"); 
    
    getCampoById().then(info => {
        
        titulo_precio.children[0].textContent = info.info_campo.nombre; 
        titulo_precio.children[1].textContent = `${info.info_campo.precio_hora}€/hora`;
        categoria.textContent = info.info_campo.modalidad_id == 1 ? "Futsal" : info.info_campo.modalidad_id == 2 ? "Tenis" : "Padel"; ;
        
    })
}


