const net = require("net");

const client = net.createConnection({ port: 8080 }, () => {
    console.log("Conectado al servidor");

    client.write("Hola servidor!");
});


client.on("data", (data) => {
    console.log(`Datos recibidos del servidor ${data}`);

    client.end();

})
client.on("end", () => {
    console.log("Desconectado del servidor");
})

