/**
 * Obtiene el valor de una cookie por su nombre
 * @param {string} name - Nombre de la cookie a buscar
 * @returns {string|null} Valor de la cookie o null si no existe
 */
export function getCookie(name) {
    // Codifica el nombre para manejar caracteres especiales
    const nameEncoded = encodeURIComponent(name) + '=';
    // Divide todas las cookies del documento
    const cookies = document.cookie.split(';');
    
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        // Elimina espacios en blanco al inicio
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }
        // Si encuentra la cookie, devuelve su valor
        if (cookie.indexOf(nameEncoded) === 0) {
            return decodeURIComponent(cookie.substring(nameEncoded.length, cookie.length));
        }
    }
    return null;
}

/**
 * Crea o actualiza una cookie
 * @param {string} name - Nombre de la cookie
 * @param {string} value - Valor a almacenar
 * @param {Object} [options] - Opciones adicionales
 * @param {number} [options.days] - Días hasta que expire (por defecto: sesión)
 * @param {string} [options.path] - Ruta donde es accesible (por defecto: '/')
 * @param {string} [options.domain] - Dominio donde es accesible
 * @param {boolean} [options.secure] - Solo enviar sobre HTTPS
 * @param {string} [options.sameSite] - Política SameSite (Lax/Strict/None)
 */
export function setCookie(name, value, options = {}) {
    let cookie = `${encodeURIComponent(name)}=${encodeURIComponent(value)}`;
    
    // Configuración de expiración
    if (options.days) {
        const date = new Date();
        date.setTime(date.getTime() + (options.days * 24 * 60 * 60 * 1000));
        cookie += `; expires=${date.toUTCString()}`;
    }
    
    // Otras opciones
    if (options.path) cookie += `; path=${options.path}`;
    if (options.domain) cookie += `; domain=${options.domain}`;
    if (options.secure) cookie += '; secure';
    if (options.sameSite) cookie += `; sameSite=${options.sameSite}`;
    
    document.cookie = cookie;
}


/**
 * Elimina una cookie estableciendo su fecha de expiración en el pasado
 * @param {string} name - Nombre de la cookie a eliminar
 * @param {Object} [options] - Opciones adicionales (deben coincidir con las usadas al crear la cookie)
 * @param {string} [options.path] - Ruta donde se estableció la cookie (por defecto '/')
 * @param {string} [options.domain] - Dominio donde se estableció la cookie
 * @param {boolean} [options.secure] - Si la cookie era segura (solo HTTPS)
 * @param {string} [options.sameSite] - Política SameSite (Lax/Strict/None)
 */
export function deleteCookie(name, options = {}) {
    // Configuración básica para invalidar la cookie
    document.cookie = [
        encodeURIComponent(name) + '=', // Nombre codificado
        '; expires=Thu, 01 Jan 1970 00:00:00 GMT', // Fecha en el pasado
        '; path=' + (options.path || '/'), // Misma ruta que al crearse
        options.domain ? '; domain=' + options.domain : '', // Dominio si se especificó
        options.secure ? '; secure' : '', // Flag secure si era true
        options.sameSite ? '; SameSite=' + options.sameSite : '' // SameSite si se usó (con mayúsculas)
    ].join('');
}
