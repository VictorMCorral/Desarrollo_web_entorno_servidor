import fs from "node:fs";
import Readline from "node:readline";

// const file = "./copia_seguridad/registro.txt";
const file = process.argv[2];


if(file === undefined) throw "Error, debe indicar un archivo de entrada";

let lines = 0;

const rl = Readline.createInterface({
    input: fs.createReadStream(file),
    crlfDelay: Infinity
});

rl.on("line", (line)=>{
    if(lines == 5) return;

    ++lines
    console.log(`En la linea ${lines} hay ${line.length} caracetes`);
})

rl.on("close", ()=>{
    console.log("Numero total de lineas " + lines);
})

