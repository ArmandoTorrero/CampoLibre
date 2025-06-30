import { getCampos } from "./../services/campo";
import { cardCampoDestacado } from "./../components/cardCampoPopular";

document.addEventListener("DOMContentLoaded", () => {

    const camposContainer = document.querySelector('article.campos');
    

    getCampos().then(campos => {
        for (let i = 0; i < 3; i++) {
            camposContainer.appendChild(cardCampoDestacado(campos[i].id, campos[i].nombre, campos[i].precio_hora, campos[i].modalidad_id, campos[i].disponible));
            
        }
    })

    

    
} )