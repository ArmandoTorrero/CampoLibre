import { BASE_URL } from "./../config/config.js";

/**
 * Funcion que devuelve todos los campos de la BBDD
 * @returns 
 */
export async function getCampos() {
    
    try {
        const response = await fetch(`${BASE_URL}/getCampos`)
        const data = await response.json(); 
        
        return data.campos; 

    } catch (error) {
        console.error(error);
        
    }
}


/**
 * Obtener un campo del backend a partir de su id en la session
 */
export async function getCampoById() {
    try {
        const response = await fetch(`${BASE_URL}/getCampoById`)
        return await response.json(); 
        
    } catch (error) {
        console.error(error);
        
    }
}


/**
 * Obtener uno o varios campos segun su nombre y la categeria
 * @param {*} campo 
 * @param {*} categoria 
 * @returns 
 */
export async function getCampoByFiltro(nombreCampo,categoria) {
    try {
        const response = await fetch(`${BASE_URL}/getCampoByfiltro`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                nombre_campo: nombreCampo,
                id_categoria: categoria
            })
        });

        return await response.json();

    } catch (error) {
        console.error(error);
    }
}