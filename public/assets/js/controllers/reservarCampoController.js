import { getHorarioByFecha } from "../services/franja_horaria.js";
import { getCampoById } from "./../services/campo.js";

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


    if (calendario.value.trim() != "") {
        getHorarioByFecha(calendario.value).then(fechas => {

            setButtonsDisabled(fechas, buttons);
            const buttonsNotDisabled = buttons.filter(btn => !btn.classList.contains("disabled")); 
            selectButton(buttonsNotDisabled); 
            activarBtnReserva(); 
        });
    }
    

    calendario.addEventListener("input", (ev) => {

        buttons.map(btn => {
            btn.disabled = false; 
            btn.classList.remove("disabled")
        })

        getHorarioByFecha(ev.target.value).then((fechas) => {
            
            setButtonsDisabled(fechas, buttons);
            const buttonsNotDisabled = buttons.filter(btn => !btn.classList.contains("disabled"));             
            selectButton(buttonsNotDisabled); 
            activarBtnReserva(); 

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
        btn.classList.add("disabled")
    })
    
}

function selectButton(buttons) {

    const detallesReserva = document.querySelector("section.info-reserva"); 

    buttons.forEach(btn => {

        btn.addEventListener("click", () =>  {

            detallesReserva.children[2].children[1].textContent = btn.textContent
            // Quitar la clase 'selected' de cualquier otro botón
            buttons.forEach(b => b.classList.remove("selected"));

            // Añadir la clase 'selected' al botón pulsado
            btn.classList.add("selected");
            activarBtnReserva(); 
        });

    });
}


function activarBtnReserva() {
    
    const btn_reserva_container = document.querySelector(".reservar"); 
    const button_selected = document.querySelector("button.selected"); 

    if (!button_selected) {
        return;
    }

    if (!button_selected.classList.contains("disabled")){
        btn_reserva_container.classList.remove("button-reservation-disabled"); 
        btn_reserva_container.querySelector("button").disabled = false; 
        btn_reserva_container.querySelector("button").addEventListener("click", () => {
            document.querySelector("dialog").showModal(); 
        })
        cerrarModal(); 
    }else{
        btn_reserva_container.classList.add("button-reservation-disabled"); 
        btn_reserva_container.querySelector("button").disabled = true; 
    }

}

export function rellenarInfoReserva() {
    
    const detallesReserva = document.querySelector("section.info-reserva"); 
    const calendario = document.getElementById("fecha"); 
    
    getCampoById().then(campo => {
        detallesReserva.children[0].children[1].textContent = campo.info_campo.nombre
        
    })

    detallesReserva.children[1].children[1].textContent = calendario.value
}

function cerrarModal() {
    const cancelarBtn = document.querySelector(".cancelar-btn");
    const dialog = document.querySelector("dialog");
    if (cancelarBtn && dialog) {
        cancelarBtn.addEventListener("click", () => {
            dialog.close();
        });
    }
}
