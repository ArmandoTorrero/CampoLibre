import { BASE_URL } from "./../config/config.js";


/**
 * Obtener lista de usuarios
 * @returns 
 */
export async function getUsuarios() {
    try {
        const response = await fetch(`${BASE_URL}/usuarios`);
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}