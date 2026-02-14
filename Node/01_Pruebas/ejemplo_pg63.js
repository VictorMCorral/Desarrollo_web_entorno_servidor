import fs from "node:fs";
import { Transform } from "node:stream";
import { pipeline } from "node:stream/promises";

const aMinusculas = new Transform({
    transform(datos, _enc, cb) {
        this.push(datos.toString('utf8').toLowerCase());
        cb();
    }
});

const cambiarTexto = new Transform({
    transform(datos, _enc, cb) {
        let textoBuscar = "hora";
        let textoCambiar = "AAAAAAAAAAAAAAAAAAAAAAA";
        let datosAlmacenados =  datos.toString("utf8").replaceAll(textoBuscar, textoCambiar);
        this.push(datosAlmacenados.toString("utf8"));
        cb();
    }
});


// fs.createReadStream("./copia_seguridad/registro.txt", { encoding: "utf8"})
//     .pipe(aMinusculas)
//     .pipe(fs.createWriteStream("./copia_seguridad/registro_transform.txt"), {enconding: "utf8"})
//     .on("finish", ()=> {
//         console.log("Transformacion a minusculas finalizada")
//     })
//     .on("error", (err)=> {
//         console.log("Transformacion a minusculas finalizada erroneamente " + err)
//     })


(async () => {
    try {
        await pipeline(
            fs.createReadStream("./copia_seguridad/registro.txt", { encoding: "utf8" }),
            cambiarTexto,
            fs.createWriteStream("./copia_seguridad/registro_transform_pipeline_textocambiado.txt", { encoding: "utf8" })
        );
        console.log("Tarea terminada con pipeline")
    } catch (error) {
        console.log("Tarea terminada con pipeline erroneamente " + error)

    }
})()
