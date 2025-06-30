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

export async function getCampo(campo,categoria) {
    try {
        const response = await fetch(`${BASE_URL}/getCampo`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                nombre_campo: campo,
                id_categoria: categoria
            })
        });

        return await response.json();

    } catch (error) {
        console.error(error);
    }
}