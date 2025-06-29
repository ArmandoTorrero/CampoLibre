import { crearElemento } from "./crearElemento.js";

export function cardCampoDestacado(id_campo,nombre,precio,categoria_id, disponible){

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
    precio_span.textContent = `${precio}€`;

    let button = crearElemento('button', 'ver-detalles');
    let enlace = crearElemento('a', 'enlace');
    enlace.textContent = "Ver detalles";
    enlace.target = "_self";

    categoria.textContent = categoria_id == 1 ? "Futsal" : categoria_id == 2 ? "Tenis" : "Padel"; 

    button.appendChild(enlace);

    precio_button.appendChild(precio_span);
    precio_button.appendChild(button);

    section_content.appendChild(nombre_campo);
    section_content.appendChild(precio_button);

    card_pista.append(article_img, section_content, categoria)

    return card_pista;
}