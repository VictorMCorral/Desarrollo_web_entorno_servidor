import fs from "node:fs";
import Readline from "node:readline";
import { Readable } from "node:stream"

let archivo_pasado = process.argv[2];
let cantidad_lineas = process.argv[3];

let archivo = `./copia_seguridad/${archivo_pasado}`;

// async function processLineByLine(archivo, cantidad_lineas){
//     const fileStream = fs.createReadStream(archivo);
//     let lines = 0;

//     const rl = Readline.createInterface({
//         input: fileStream,
//         crlfDelay: Infinity
//     })

//     for await (const line of rl){
//         if(lines == cantidad_lineas) return;

//         ++lines
//         console.log(`Linea ${lines} => ${line}`);
//     }
// }

// processLineByLine(archivo, cantidad_lineas);


async function* leerLineas(archivo) {
    const fileStream = fs.createReadStream(archivo, { encoding: "utf8" });

    const rl = Readline.createInterface({
        input: fileStream,
        crlfDelay: Infinity
    })


    for await (const linea of rl) {
        yield linea;
    }


}

async function procesarArchivo(archivo, cantidad_lineas) {
    const iteradorDeLineas = leerLineas(archivo);

    
    //Cierra el stream automáticamente: Una vez que se han procesado esas N líneas, el método .take() finaliza el stream (emite el evento end).
    
    const streamLimitado = Readable.from(iteradorDeLineas).take(cantidad_lineas);

    //Eficiencia: Al llegar al límite, deja de pedir más datos al iteradorDeLineas. Esto es muy útil si el archivo original tiene millones de 
    // líneas pero tú solo quieres procesar las primeras 100, ya que evita leer el resto del archivo innecesariamente.
    let lineas = 0;

    streamLimitado.on('data', () => {
        console.log(`--------------------------------- ${lineas} ---------------------------------`);
    });
    
    streamLimitado.on('close', () => {
        console.log("\n----------- El stream ha finalizado de emitir datos. -----------\n");
        streamLimitado.destroy();
    });
    
    for await (const linea of streamLimitado) {
        lineas++;
        console.log(`Procesando linea ${lineas}: ${linea}`)
    }
}


procesarArchivo(archivo, cantidad_lineas);


