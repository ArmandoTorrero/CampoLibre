import { sendForm } from "./../components/sendForm.js";
import { validateEmail } from "./../utils/validateEmail.js";
import { validatePasswd } from "./../utils/validatePasswd.js";

export function validarForm() {

    const email = document.getElementById("email"); 
    const passwd = document.getElementById("passwd");
    const spans = document.querySelectorAll(".label-input span");
    const btn_submit = document.querySelector(".enviar"); 

    // variables para comprobar si estan validados los inputs
    let emailValidado = false; 
    let passwdValidada = false; 

    email.addEventListener("input", (ev) => {
        if (validateEmail(ev.target.value)) {

            spans[0].classList.add("noVisible"); 
            spans[0].classList.remove("visible");
            emailValidado = true;
        }else{
            spans[0].classList.remove("noVisible"); 
            spans[0].classList.add("visible");
            emailValidado = false;
        }

        if (emailValidado && passwdValidada) {
            btn_submit.disabled = false; 
            btn_submit.classList.remove("disabled"); 
        }else{
            btn_submit.disabled = true; 
            btn_submit.classList.add("disabled");
        }
        
    })

    passwd.addEventListener("input", (ev) => {

        if (validatePasswd(ev.target.value)) {
            spans[1].classList.add("noVisible"); 
            spans[1].classList.remove("visible");
            passwdValidada = true;
        }else{
            spans[1].classList.remove("noVisible"); 
            spans[1].classList.add("visible");
            passwdValidada = false;
        }

        if (emailValidado && passwdValidada) {
            btn_submit.disabled = false; 
            btn_submit.classList.remove("disabled"); 
        }else{
            btn_submit.disabled = true; 
            btn_submit.classList.add("disabled");
        }
        
    })
}



export function initForm(form, ruta) {
    
    sendForm(form, ruta).then((result) => {
        console.log(result);
        
    }).catch((err) => {
        console.log(err);
        
    });
}