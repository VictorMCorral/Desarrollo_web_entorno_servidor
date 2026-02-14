//1- Dado un archivo original.txt crea una copia llamada original_backup.txt
//2- si el archivo original no existe, muestra un error controlado por consola.
//3- si la copia se crea correctamente, muestra un mensaje de exito
//4- Antes de copiar, comprueba si el archivo existe usando asccess

import fs from "fs";

fs.access("./copia_seguridad/original.txt", (err) => {
    if (err) {
        console.error("El archivo no existe");
        return;
    }

    console.log();
    console.log("El orginal existe");
    console.log();

    fs.access("./copia_seguridad/original_backup.txt", (err) => {
        if (err) {
            fs.copyFile("./copia_seguridad/original.txt", "./copia_seguridad/original_backup.txt", (err) => {
                if (err) {
                    console.error("El archivo no existe");
                    console.log();
                    return;
                };
                console.log("Archivo copiado correctamente")
                console.log();
                return;
            });
            return;
        }

        console.log("El backup ya existe")
        console.log();
    });

});


function comprobarExistencia(archivo) {
    fs.access(archivo, (err) => {
        if (err) {
            console.error("El archivo no existe");
            return false;
        }
        

        console.error("El archivo no existe");
        return true;
    });

}
