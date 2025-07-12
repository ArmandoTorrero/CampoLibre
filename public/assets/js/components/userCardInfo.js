import { getUserInfo } from "./../services/user.js";
import { crearElemento } from "./crearElemento.js";
import { crearForm } from "./form.js";
import { validarForm } from "./validarForm.js";


export function userInfoCard() {

    const container = crearElemento("section", "datos_container"); 
    const titulo = crearElemento("h1", "datos_personales"); 
    titulo.textContent = "Datos personales"; 
    
    container.appendChild(titulo)

    getUserInfo().then(info => {
        
        let array_labels = ['Nombre', 'Correo electrónico', 'Teléfono'];
        let array_values = [info.user.nombre,info.user.email,info.user.tlf]
        let array_types = ["text", "email", "number"]; 

        const form = crearForm(
            array_labels,
            array_types,
            array_values, 
            '/editUser',
        ); 

        const inputs = [...form.querySelectorAll("input")]; 
        const spans = [...form.querySelectorAll("span")]; 
        const buttonSubmit = form.querySelector("button") 

        validarForm(
            inputs,
            spans,
            [
                /^[a-zA-Z0-9]{3,15}$/, 
                /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/, 
                /^\d{9}$/
            ],
            buttonSubmit
        )
        
        container.appendChild(form); 

    })

    return container; 

}

