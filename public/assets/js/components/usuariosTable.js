import { tabla } from "./../controllers/adminController.js";
import { getUsuarios } from "./../services/user.js";
import { crearBoton } from "./button.js";
import { crearForm } from "./form.js";
import { initForm } from "./initForm.js";
import { crearInput } from "./input.js";


export async function usuariosTable() {

    const titulo = document.querySelector(".titulo"); 
    titulo.textContent = "Usuarios";

    const content = document.querySelector(".content .table"); 
    content.innerHTML = ""; 

    const table = tabla("usuarios"); 
    content.appendChild(table); 

    const { usuarios } = await getUsuarios()
    const usuarios_obj = Object.values(usuarios).map(item => ({
        id: item.id,
        nombre: item.nombre, 
        email: item.email, 
        tlf: item.tlf
    }))
    
    $("#usuarios").DataTable({
        destroy:true, 
        data: usuarios_obj, 
        responsive: true,
        columns: [
            { title: "Nombre", data: "nombre"},
            { title: "Correo", data: "email"},
            { title: "Teléfono", data: "tlf"},
            { title: "Acciones", data: null, render: function(data, type, row)  {
                    return deleteUser(row.id).outerHTML;    
                } 
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' // Español
        }
    })

    document.querySelector("#usuarios").addEventListener("submit", (ev) => {

        if (ev.target.matches("form")) {
            ev.preventDefault();
            Swal.fire({
                title: "¿Estas seguro?",
                text: "No podras revertirlo",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar usuario", 
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    initForm(ev.target, '/deleteUser');
                    ev.target.closest("tr").remove();
                }
            });
            
            
        }
    })

}

function deleteUser(id) {
    
    const button = crearBoton("Eliminar","btn", "submit");
    button.classList.add("btn-danger");
    const input_hidden = crearInput("id_usuario", "hidden", id);
    const form = document.createElement("form");
    form.method = "POST";
    form.appendChild(button); 
    form.appendChild(input_hidden);

    return form; 

}