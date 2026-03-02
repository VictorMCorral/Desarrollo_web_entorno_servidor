const net = require("net");

let contador = 0;

const server = net.createServer((socket) => {
    let contadorCliente = contador +1;
    contador ++;
    
    if(contador > 3){
        socket.end();
    }

    console.log(`Partida encontrada, cliente-${contadorCliente} conectado`);
    socket.write("Bienvenido a fortaleza 404");


    socket.on("data", (data) => {
        let dataUp = data;

        if(contadorCliente === 2){
            dataUp = data.toString().toUpperCase();
        };

        console.log(`Datos recibidos del cliente-${contadorCliente}: ${data}`);
        console.log("=================")
        socket.write(`Echo: ${dataUp}`);

    });

    socket.on("end", () => {
        console.log("Cliente desconectado");
    });

    socket.on("error", (err) => {
        console.log("Error en el socket: ", err);
    });

});

server.listen(8080, () => {
    console.log("Servidor TCP escuchando en el puerto 8080")
} )