

export function buttonSelected(buttons, clase) {
    
    buttons.map((button) => {
    button.addEventListener("click", (ev) => {

        buttons.map(btn => btn.classList.remove(clase)); 

        button.classList.add(clase); 
    });
  });
}