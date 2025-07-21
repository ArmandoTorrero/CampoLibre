import { getCampos } from "./../services/campo.js";
import { cardCampoDestacado } from "./../components/cardCampoPopular.js";


document.addEventListener("DOMContentLoaded", () => {

    const camposContainer = document.querySelector('article.campos');
    
    getCampos().then(campos => {
        
        campos.slice(0,3).map(campo => {
            camposContainer.appendChild(cardCampoDestacado(campo));
            
        })
    })

    
} )