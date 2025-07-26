import { getUserInfo } from "./../services/user.js";
import { crearBoton } from "./button.js";
import { crearElemento } from "./crearElemento.js";
import { crearForm } from "./form.js";
import { validarForm } from "./validarForm.js";

export function userInfoCard() {
  const container = crearElemento("section", "datos_container");
  const titulo = crearElemento("h1", "datos_personales");
  titulo.textContent = "Datos personales";

  container.appendChild(titulo);

  getUserInfo().then((info) => {
    let array_labels = ["Nombre", "Correo electrónico", "Teléfono"];
    let array_values = [info.user.nombre, info.user.email, info.user.tlf];
    let array_types = ["text", "email", "number"];

    const button = crearBoton("Enviar", "disabled", "submit");
    const form = crearForm(
      array_labels,
      array_types,
      array_values,
      "/editUser",
      button
    );

    const inputs = [...form.querySelectorAll("input")];
    const spans = [...form.querySelectorAll("span")];

    validarForm(
      inputs,
      spans,
      [
        /^[a-zA-Z0-9\s]{3,50}$/, // permite espacios en cualquier posición
        /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/,
        /^\d{9}$/,
      ],
      button
    );

    container.appendChild(form);
  });

  return container;
}
