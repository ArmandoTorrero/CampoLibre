import { crearLabel } from "./label.js";
import { crearInput } from "./input.js";
import { crearBoton } from "./button.js";
import { crearSpan } from "./span.js";
import { initForm } from "./initForm.js";

export function crearForm(labels,input_types ,values, ruta) {

    const form = document.createElement("form");
    form.action = ruta;
    form.method = "POST";

    labels.forEach((labelText, i) => {
        const section = document.createElement("section");
        section.className = "label-input";

        const label = crearLabel(labelText);
        label.htmlFor = `input_${i}`;

        const input = crearInput(`input_${i}`,input_types[i],values[i]);
        input.id = `input_${i}`;

        section.appendChild(label);
        section.appendChild(input);
        section.appendChild(crearSpan()); 
        form.appendChild(section);
    });

    const button = crearBoton("Enviar", "disabled", "submit")
    
    form.appendChild(button);


    form.addEventListener("submit", async (ev) => {
        ev.preventDefault(); 

        initForm(form, ruta); 
    })
    
    return form;
}