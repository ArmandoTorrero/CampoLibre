import { crearInput } from "./../components/input.js";
import { getHorarioByFecha } from "./../services/franja_horaria.js";
import { getCampoById } from "./../services/campo.js";
import { logueado } from "./../services/user.js";
import { BASE_URL } from "./../config/config.js";
import { buttonSelected } from "./../components/buttonSelected.js";

/**
 * Rellenar la información del campo
 */
export function infoCampo() {
  const titulo_precio = document.querySelector("article.titulo-precio");
  const categoria = document.querySelector("article.categoria > p");

  getCampoById().then((info) => {
    titulo_precio.children[0].textContent = info.info_campo.nombre;
    titulo_precio.children[1].textContent = `${info.info_campo.precio_hora}€/hora`;
    categoria.textContent =
      info.info_campo.modalidad_id == 1
        ? "Futsal"
        : info.info_campo.modalidad_id == 2
        ? "Tenis"
        : "Padel";
  });
}

/**
 * Mostrar que botones se pueden pulsar y cuales no
 * @param {*} calendario 
 */
export function initReserva(calendario) {

    const buttons = [...document.querySelectorAll(".horario")];

    // si el calendario ya tiene un valor hacemos la logica 
    if (calendario.value.trim() != "") {

        desactivarHorasPasadas(buttons, calendario.value);

        getHorarioByFecha(calendario.value).then(fechas => {

            setButtonsDisabled(fechas, buttons);
            const buttonsNotDisabled = buttons.filter(btn => !btn.classList.contains("disabled")); 
            buttonSelected(buttonsNotDisabled, 'selected');
            activarReserva(buttonsNotDisabled); 
        });
    }
    
    // cuando el usuario pulse una fecha se activa la lógica
    calendario.addEventListener("input", (ev) => {
        
        desactivarHorasPasadas(buttons, ev.target.value);
        
        buttons.map(btn => {
            btn.disabled = false; 
            btn.classList.remove("btnHorarioDisabled")
        })

        getHorarioByFecha(ev.target.value).then((fechas) => {
                        
            setButtonsDisabled(fechas, buttons);
            const buttonsNotDisabled = buttons.filter(btn => !btn.classList.contains("disabled"));             
            buttonSelected(buttonsNotDisabled, 'selected'); 
            activarReserva(buttonsNotDisabled); 

        });
    });

}

/**
 * Desactivar los botones cuyos 'values' coincidan con las horas
 * @param {*} array_horas 
 * @param {*} array_btns 
 */
function setButtonsDisabled(array_horas, array_btns) {

    let horarios = array_horas.horarios.map(hora => hora.hora_inicio.slice(0, 5));

    const disabledButtons = array_btns.filter(btn => horarios.includes(btn.value))

    disabledButtons.map(btn => {
        btn.disabled = true; 
        btn.classList.add("btnHorarioDisabled")
    })
    
}

/**
 * Funcion para activar la reserva y proporcionar la hora en el modal cuando el usuario vaya a pagar
 * @param {*} buttons 
 */
function activarReserva(buttons) {

    const detallesReserva = document.querySelector("section.info-reserva");
    activarBtnReserva(); 
    
    buttons.map(btn => {
        
        btn.addEventListener("click", () => {

            // Mostramos la hora que ha pulsado el usuario en el modal
            detallesReserva.children[2].children[1].textContent = btn.textContent
            activarBtnReserva(); 
        })
    })
}

/**
 * Funcion para activar o desactivar el boton de reservar segun si el horario esta habilitado o no 
 * @returns 
 */
function activarBtnReserva() {
    
    // recogemos el contenedor y el boton seleccionado
    const btn_reserva_container = document.querySelector(".reservar"); 
    const button_selected = document.querySelector("button.selected"); 

    if (!button_selected) return; // si no hay boton seleccionado paramos la logica

    // si el boton no esta desactivado se activa el boton de reservar para mostrar el modal
    if (!button_selected.classList.contains("btnHorarioDisabled")){

        btn_reserva_container.classList.remove("button-reservation-disabled"); 
        btn_reserva_container.querySelector("button").disabled = false; 
        btn_reserva_container.querySelector("button").addEventListener("click", () => {
            redirigirLogin(); 
            openModal(); 
        })
        cerrarModal(); 

    }else{ // si esta desactivado evitamos el funcionamiento del boton de reservar
        btn_reserva_container.classList.add("button-reservation-disabled"); 
        btn_reserva_container.querySelector("button").disabled = true; 
    }

}

/**
 * Función para desactivar los botones de horas pasadas
 * @param {*} buttons 
 * @param {*} fechaSeleccionada 
 */
function desactivarHorasPasadas(buttons, fechaSeleccionada) {
  const hoy = new Date();
  const fechaHoy = hoy.toISOString().slice(0, 10); // formato yyyy-mm-dd

  if (fechaSeleccionada === fechaHoy) {
    const horaActual = hoy.getHours();
    buttons.forEach(btn => {
      const horaBtn = parseInt(btn.value.split(":")[0], 10);
      if (horaBtn <= horaActual) {
        btn.disabled = true;
        btn.classList.add("btnHorarioDisabled");
      }
    });
  }
}

/**
 * Función para rellenar el modal con la informacion correspondiente
 */
export function rellenarInfoReserva() {
    
    const detallesReserva = document.querySelector("section.info-reserva"); 
    const calendario = document.getElementById("fecha"); 
    
    getCampoById().then(campo => {
        
        detallesReserva.children[0].children[1].textContent = campo.info_campo.nombre        
    })

    detallesReserva.children[1].children[1].textContent = calendario.value
}

/**
 * Función para abrir el modal
 */
function openModal() {
    const dialog = document.querySelector("dialog");
    dialog.showModal();    
    
}

/**
 * Función para cerrar el modal
 */
function cerrarModal() {

    const cancelarBtn = document.querySelector(".cancelar-btn");
    const dialog = document.querySelector("dialog");
    if (cancelarBtn && dialog) {
        cancelarBtn.addEventListener("click", () => {
            dialog.close();
        });
    }
}

/**
 * Función para añadir el valor del calendario y el horario seleccionado por el usuario
 */
export function addDataForm() {
    
    const form = document.querySelector("form"); 
    const button_selected_value = document.querySelector("button.selected").value; 
    const calendario_value = document.getElementById("fecha").value; 

    const input_hidden_fecha = crearInput('fecha', 'hidden', calendario_value); 
    const input_hidden_horario = crearInput('horario', 'hidden', `${button_selected_value}:00`); 

    form.append(input_hidden_fecha,input_hidden_horario); 

}

/**
 * Función para redirigir al usuario en caso de que no este logueado
 */
function redirigirLogin() {
    logueado().then(info => {                
        info.rol == false ? window.location.href = `${BASE_URL}/login` : ''; 
    })
}