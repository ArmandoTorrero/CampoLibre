import { crearOption } from "./../components/createOption";
import { getModalidades } from "./../services/modalidad";
import { cardCampoDestacado } from "./../components/cardCampoPopular";
import { getCampo } from "./../services/campo";


/**
 * Funcion para rellenar un select con las modalidades
 * @param {*} select 
 */
export function selectModalidad(select) {
    
    getModalidades().then(modalidades => {
        modalidades.modalidades.map(modalidad => {
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
    

    buscador.addEventListener("input", (ev) => {

        camposContainer.innerHTML = ""; // Limpiar los campos antes de mostrar los resultados
                
        getCampo(ev.target.value, select.value).then(data => {

            data.campos.map(campo => {
                camposContainer.appendChild(
                    cardCampoDestacado(campo.id, campo.nombre, campo.precio_hora, campo.modalidad_id, campo.disponible)
                )
            })
            
            
        })
    })

    select.addEventListener("input", (ev) => {

        camposContainer.innerHTML = ""; // Limpiar los campos antes de mostrar los resultados

        getCampo(buscador.value, ev.target.value).then(data => {
            
            data.campos.map(campo => {
                camposContainer.appendChild(
                    cardCampoDestacado(campo.id, campo.nombre, campo.precio_hora, campo.modalidad_id, campo.disponible)
                )
            })
        })
        
    })
}