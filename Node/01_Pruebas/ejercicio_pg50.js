import fs from "node:fs/promises";

const archivo = "./copia_seguridad/saludo.txt";
const archivo2 = "./copia_seguridad/registro.txt";

async function comprobarExistencia(archivo) {
    try {
        await fs.access(archivo);
        // console.log("El archivo sí existe");
        return true;
    } catch {
        // console.error("El archivo no existe");
        return false;
    }
}

async function sobreEscribir(archivo) {

    if (await comprobarExistencia(archivo)) {
        const dataBefore = await fs.readFile(archivo, "utf-8");
        console.log("Datos antes de sobreescribir: \n\t", dataBefore);


        await fs.writeFile(archivo, "Estoy sobreescribiendo el archivo.");

        const data = await fs.readFile(archivo, "utf-8");
        console.log("Datos leidos:\n\t", data);
    }
}


async function registro(archivo) {
    if (await comprobarExistencia(archivo)) {
        const dataBefore = await fs.readFile(archivo, "utf-8");
        console.log("Datos antes de sobreescribir: \n\t", dataBefore);
        const fecha = new Date().toString();

        await fs.writeFile(archivo, `${fecha}\n`, { flag: "a" });

        const data = await fs.readFile(archivo, "utf-8");
        console.log("Datos leidos:\n", data);
    }
}

(async () => {
    await sobreEscribir(archivo);
    console.log();
    await registro(archivo2);
})()



