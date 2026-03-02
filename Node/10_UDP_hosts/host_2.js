const dgram = require("dgram");
const cliente = dgram.createSocket("udp4");
const readline = require("readline");

const message = Buffer.from("Hola servidor UDP");

cliente.send(message, 4123, "localhost", (error) => {
    if (error) {
        console.error("Error al enviar el mensaje", error);
        cliente.close();
    } else {
        console.log("Mensaje enviado al servidor");
    }
});

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
})

rl.on("line", (input) => {
    cliente.send(input, 4123, "localhost", (error) => {
        if (error) {
            console.error("Error al enviar el mensaje", error);
            cliente.close();
        } else {
            console.log("Mensaje enviado al servidor");
        }
    });
})


cliente.on("message", (msg) => {
    console.log("cliente recibio: " + msg);

    if (msg == "*") {
        cliente.close();
        rl.close();
        return
    }
});