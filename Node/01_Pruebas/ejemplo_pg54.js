import fs from "node:fs";

let archivo = "./copia_seguridad/registro.txt";
let datos = "";

const stream = fs.createReadStream(archivo, {encoding: "utf-8"});

stream.once("data", () => {
    console.log("Comenzamos a leer");
});

stream.on("data", chunk => {
    console.log("Leyendo 64 Kb...")
    datos += chunk;
});

stream.on("end", () => {
    console.log("Longitud del registro: " + datos.length);
});