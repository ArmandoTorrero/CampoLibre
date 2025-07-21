import { BASE_URL } from "./../config/config.js";
import { logueado } from "./../services/user.js";
import { crearElemento } from "./crearElemento.js";

/**
 * Componente que crea una carta de un campo 
 * @param {*} id
 * @param {*} nombre 
 * @param {*} precio_hora 
 * @param {*} modalidad_id 
 * @param {*} disponible 
 * @returns 
 */
export function cardCampoDestacado({ id,nombre,precio_hora,modalidad_id, disponible }){

    let card_pista = crearElemento('article', 'pista'); 

    // Creamos la seccion para la imagen, otra para el contenido de la carta y otra para la categoria
    let article_img = crearElemento('article', 'img')
    article_img.classList.add('bg-img');
    let section_content = crearElemento('section', 'content');
    let categoria = crearElemento('p', 'categoria');

    // Creamos el contenido de la carte
    let nombre_campo = crearElemento('h2', 'nombre_campo');
    nombre_campo.textContent = nombre;
    let precio_button = crearElemento('article', 'precio-button');

    // Añadimos el precio y el boton junto con el enlace
    let precio_span = crearElemento('span', 'precio');   
    precio_span.textContent = `Desde ${precio_hora}€/hora`;

    let button = crearElemento('button', 'ver-detalles');
    let enlace = crearElemento('a', 'enlace');

    enlace.target = "_self";

    logueado().then(info => {
        
        if (!info.rol) {
            enlace.href = `${BASE_URL}/login`; 
            enlace.textContent = "Iniciar sesión"
        }
        
        if (info.rol === 1) {
            enlace.textContent = "Reservar";
            enlace.href = `${BASE_URL}/reservarCampo?id_campo=${id}`;
        }

        if (disponible !== 1) {
            card_pista.style.opacity = ".5"
            
            enlace.addEventListener("click", (ev) => {
                ev.preventDefault(); 
            })
            enlace.textContent = "No disponible"; 
        }
    })    
    
    categoria.textContent = modalidad_id == 1 ? "Futsal" : modalidad_id == 2 ? "Tenis" : "Padel"; 

    button.appendChild(enlace);

    precio_button.appendChild(precio_span);
    precio_button.appendChild(button);

    section_content.appendChild(nombre_campo);
    section_content.appendChild(precio_button);

    card_pista.append(article_img, section_content, categoria)

    return card_pista;
}