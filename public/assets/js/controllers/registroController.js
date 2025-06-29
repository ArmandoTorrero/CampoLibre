import { validateEmail } from "./../utils/validateEmail.js";
import { validateName } from "./../utils/validateName.js";
import { validatePasswd } from "./../utils/validatePasswd.js";
import { validatePhoneNumber } from "./../utils/validatePhoneNumber.js";
import { sendForm } from "./../components/sendForm.js";

export function validarForm() {

    const nombre = document.getElementById("nombre");
    const email = document.getElementById("email"); 
    const passwd = document.getElementById("passwd");
    const tlf = document.getElementById("tlf");
    const spans = document.querySelectorAll(".label-input span");
    const btn_submit = document.querySelector(".enviar"); 

    
    // variables para comprobar si estan validados los inputs
    let emailValidado = false; 
    let passwdValidada = false; 
    let nombreValido = false; 
    let tlfValido = false; 

    nombre.addEventListener("input", (ev) => {
        if (validateName(ev.target.value)) {

            spans[0].classList.add("noVisible"); 
            spans[0].classList.remove("visible");
            nombreValido = true;
        }else{
            spans[0].classList.remove("noVisible"); 
            spans[0].classList.add("visible");
            nombreValido = false;
        }

        if (emailValidado && passwdValidada && nombreValido && tlfValido) {
            btn_submit.disabled = false; 
            btn_submit.classList.remove("disabled"); 
        }else{
            btn_submit.disabled = true; 
            btn_submit.classList.add("disabled");
        }
        
    })

    email.addEventListener("input", (ev) => {
        if (validateEmail(ev.target.value)) {

            spans[1].classList.add("noVisible"); 
            spans[1].classList.remove("visible");
            emailValidado = true;
        }else{
            spans[1].classList.remove("noVisible"); 
            spans[1].classList.add("visible");
            emailValidado = false;
        }

        if (emailValidado && passwdValidada && nombreValido && tlfValido) {
            btn_submit.disabled = false; 
            btn_submit.classList.remove("disabled"); 
        }else{
            btn_submit.disabled = true; 
            btn_submit.classList.add("disabled");
        }
        
    })

    passwd.addEventListener("input", (ev) => {

        if (validatePasswd(ev.target.value)) {
            spans[2].classList.add("noVisible"); 
            spans[2].classList.remove("visible");
            passwdValidada = true;
        }else{
            spans[2].classList.remove("noVisible"); 
            spans[2].classList.add("visible");
            passwdValidada = false;
        }

        if (emailValidado && passwdValidada && nombreValido && tlfValido) {
            btn_submit.disabled = false; 
            btn_submit.classList.remove("disabled"); 
        }else{
            btn_submit.disabled = true; 
            btn_submit.classList.add("disabled");
        }
        
    })

    tlf.addEventListener("input", (ev) => {

        if (validatePhoneNumber(ev.target.value)) {
            spans[3].classList.add("noVisible"); 
            spans[3].classList.remove("visible");
            tlfValido = true;
        }else{
            spans[3].classList.remove("noVisible"); 
            spans[3].classList.add("visible");
            tlfValido = false;
        }

        if (emailValidado && passwdValidada && nombreValido && tlfValido) {
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