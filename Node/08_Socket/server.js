const net = require("net");

const server = net.createServer((socket) => {
    console.log("Partida encontrada, cliente conectado");

    socket.write("Bienvenido a fortaleza 404");

    socket.on("data", (data) => {
        console.log(`Datos recibidos del cliente: ${data}`);
        socket.write(`Echo: ${data}`);
    });

    socket.on("end", () => {
        console.log("Cliente desconectado");
    });

});

server.listen(8080, () => {
    console.log("Servidor TCP escuchando en el puerto 8080")
} )