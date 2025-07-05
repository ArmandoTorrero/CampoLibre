import { reservasContainer } from "./../components/reservasContainer.js";
import { userInfoCard } from "./../components/userCardInfo.js";
import { getAll } from "./../services/reserva.js";
import { getUserInfo } from "./../services/user.js";

function clearContent(btn,callBack) {

    const dinamic_content = document.querySelector(".content");

    btn.addEventListener("click", () => {
        dinamic_content.innerHTML = ""; 
        dinamic_content.appendChild(callBack())
    })

}


export function userInfo() {
    
    const user_info_container = document.querySelector(".user-info"); 
    const additional_info_container = document.querySelector(".additional-info"); 
    const dinamic_content = document.querySelector(".content"); 
    const reservasButton = document.querySelector("button.reservas"); 

    getUserInfo().then(info => {
        user_info_container.children[0].textContent = info.user.nombre; 
        user_info_container.children[1].textContent = info.user.email
        
    })

    getAll().then(result => {
        additional_info_container.children[1].textContent = `${result.reservas.length} reservas completadas`; 
        
        dinamic_content.appendChild(reservasContainer(result.reservas)); 
        clearContent(reservasButton,() => reservasContainer(result.reservas))
        
    })

}


export function initPerfil() {

    userInfo(); 

    const btn_ajustes = document.querySelector(".ajustes"); 

    clearContent(btn_ajustes, () => userInfoCard()); 

}



