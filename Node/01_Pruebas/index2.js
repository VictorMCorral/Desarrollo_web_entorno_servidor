
import { Persona } from "./persona.mjs";

console.log();
const newPersona = new Persona("Victor", "Manuel Corral", 37);
console.log(newPersona.mostrar());
console.log();


console.log("Inicio del programa");
let despedirse = function(nombre, callback2) {
    console.log("Adios " + nombre);
    callback2();
}

function seguir(){
    console.log("Aqui continuamos con el flujo del programa");
}

function saludar (nombre, callback, callback2){
    console.log("Hola " + nombre);
    setTimeout(function () {callback(nombre, callback2)}, 250);
}

saludar("Juan", despedirse, seguir);
