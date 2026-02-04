console.log("Entre en el index.js")

const colors = require("colors");


console.log("Hola desde index.js en verde".green);

const axios = require("axios").default;
console.log();

// axios.get("https://rickandmortyapi.com/api/character")
//     .then(response => {
//         console.log(response.data);
//     })
//     .catch(error => {
//         console.log(error);
//     })

// const operaciones = require("./operaciones");
// const dividr = operaciones.dividir(5, 0);
// console.log(dividr);

const { sumar } = require("./operaciones");
const sumarOp = sumar(5,5)
console.log();

console.log(sumarOp);

console.log();

const Persona = require("./persona");
const newPersona = new Persona("Victor", "Manuel", "37")
console.log(newPersona.mostrar())
console.log();


