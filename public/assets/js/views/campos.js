
import { getCampos } from "./../services/campo";
import { initCampos, initFiltros, selectModalidad } from "./../controllers/camposController";


document.addEventListener("DOMContentLoaded", () => {

    const select = document.querySelector('select#categoria');
    
    getCampos().then(campos => {
        
        initCampos(campos); 
    })

    selectModalidad(select); 
    initFiltros(); 
})