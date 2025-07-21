import { crearOption } from "./../components/createOption";
import { getModalidades } from "./../services/modalidad";
import { cardCampoDestacado } from "./../components/cardCampoPopular";
import { getCampoByFiltro } from "./../services/campo";


/**
 * Funcion para rellenar un select con las modalidades
 * @param {*} select 
 */
export function selectModalidad(select) {
    
    getModalidades().then(response => {

        const { modalidades } = response

        modalidades.map(modalidad => {
            select.appendChild(crearOption(modalidad.nombre, modalidad.id));
        }); 
        
    })
}

/**
 * Función para inicializar todos los campos 
 */
export function initCampos(campos){

    const camposContainer = document.querySelector("section.campos"); 

        campos.map(campo => {
            camposContainer.appendChild(
                cardCampoDestacado(campo.id, campo.nombre, campo.precio_hora, campo.modalidad_id, campo.disponible)
            )
        })
    
}


export function initFiltros() {

    const camposContainer = document.querySelector("section.campos"); 
    const buscador = document.getElementById("buscador");
    const select = document.getElementById("categoria");
    const form = document.querySelector("form.filtros");

    form.addEventListener("submit", (ev) => {
        ev.preventDefault();
        
        camposContainer.innerHTML = ""; // Limpiar los campos antes de mostrar los resultados

        getCampoByFiltro(buscador.value, select.value).then(data => {
            
            const { campos } = data;
            
            if (campos.length !== 0) {

                campos.map(campo => {
                    camposContainer.appendChild(
                        cardCampoDestacado(campo.id, campo.nombre, campo.precio_hora, campo.modalidad_id, campo.disponible)
                    )
                })

            }else{
                let noResults = document.createElement("h2");
                noResults.textContent = "No se encontraron campos";
                camposContainer.appendChild(noResults);
            }

            
        })
        
    })

}