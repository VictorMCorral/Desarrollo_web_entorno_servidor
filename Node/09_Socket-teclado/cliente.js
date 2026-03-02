const net = require("net");
const readline = require("readline");

const client = net.createConnection({ port: 8080 }, () => {
    console.log("Conectado al servidor");

    client.write("Hola servidor!");
});

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
})

rl.on("line", (input) => {
    client.write(input);
})

client.on("data", (data) => {
    console.log(`Datos recibidos del servidor ${data}`);
})

client.on("end", () => {
    console.log("Desconectado del servidor");
})

