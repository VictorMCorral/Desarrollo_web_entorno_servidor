// console.log('PID: ', process.pid);
// console.log(`Cantidad de argumentos recibidos: ${process.argv.length}`);
// console.log('Argumentos: ', process.argv);


// const { sumar } = require("./operaciones");
// const sumarOp = sumar(Number(process.argv[2]),Number(process.argv[3]))
// console.log();

// console.log("La suma es: " + sumarOp);


// const Persona = require("./persona");
// const newPersona = new Persona(process.argv[4], process.argv[5], Number(process.argv[6]))
// console.log(newPersona.mostrar())
// console.log();

import { Persona } from "./persona.mjs";

const newPersona = new Persona("Orwin", "Zavaleta", 19);
console.log(newPersona.mostrar());