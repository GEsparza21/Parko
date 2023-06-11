var input = document.getElementById("Nombre");
var input2 = document.getElementById("Apellido");
var input3 = document.getElementById("Correo");
var input4 = document.getElementById("Piso");
var input5 = document.getElementById("Apartamento");
var input6 = document.getElementById("Cajon");
var input7 = document.getElementById("Telefono");
var btnEdit = document.getElementById("btnedit");
var btnDesactivar = document.getElementById("btnsave");

// Deshabilitar el campo de entrada de texto
input.disabled = true;
input2.disabled = true;
input3.disabled = true;
input4.disabled = true;
input5.disabled = true;
input6.disabled = true;
input7.disabled = true;

//si se preciona el boton editar debe habilitar los campos
function habilitar(){
    input.disabled = false;
    input2.disabled = false;
    input3.disabled = false;
    input4.disabled = false;
    input5.disabled = false;
    input6.disabled = false;
    input7.disabled = false;
}

function desactivar(){
    input.disabled = true;
    input2.disabled = true;
    input3.disabled = true;
    input4.disabled = true;
    input5.disabled = true;
    input6.disabled = true;
    input7.disabled = true;
}
// Habilitar el campo de entrada de texto
//input.disabled = false;