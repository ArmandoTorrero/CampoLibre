import { crearOption } from "./../components/createOption.js";
import { getModalidades } from "./../services/modalidad.js";
import { cardCampoDestacado } from "./../components/cardCampoPopular.js";
import { getCampoByFiltro } from "./../services/campo.js";


/**
 * Funcion para rellenar un select con las modalidades
 * @param {*} select 
 */
export async function selectModalidad(select) {

    const { modalidades } = await getModalidades();

    modalidades.map(modalidad => {
        select.appendChild(crearOption(modalidad.nombre, modalidad.id));
    }); 
    
}

/**
 * Función para inicializar todos los campos 
 */
export function initCampos(campos){

    const camposContainer = document.querySelector("section.campos"); 

        campos.map(campo => {            
            camposContainer.appendChild(
                cardCampoDestacado(campo)
            )
        })
    
}


export function initFiltros() {

    const camposContainer = document.querySelector("section.campos"); 
    const buscador = document.getElementById("buscador");
    const select = document.getElementById("categoria");
    const form = document.querySelector("form.filtros");

    form.addEventListener("submit", async (ev) => {

        ev.preventDefault();
        
        camposContainer.innerHTML = ""; // Limpiar los campos antes de mostrar los resultados

        const { campos } = await getCampoByFiltro(buscador.value, select.value);

        if (campos.length !== 0) {

            campos.map(campo => {
                camposContainer.appendChild(
                    cardCampoDestacado(campo)
                )
            })

        }else{
            let noResults = document.createElement("h2");
            noResults.textContent = "No se encontraron campos";
            camposContainer.appendChild(noResults);
        }

        
    })

}