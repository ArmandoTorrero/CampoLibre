import { getCampos } from "./../services/campo.js";
import { cardCampoDestacado } from "./../components/cardCampoPopular.js";


document.addEventListener("DOMContentLoaded", () => {

    const camposContainer = document.querySelector('article.campos');
    
    getCampos().then(campos => {
        for (let i = 0; i < 3; i++) {
            camposContainer.appendChild(cardCampoDestacado(campos[i].id, campos[i].nombre, campos[i].precio_hora, campos[i].modalidad_id, campos[i].disponible));
            
        }
    })

    
} )