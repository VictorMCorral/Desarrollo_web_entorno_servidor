const WebSocket = require("ws");

const wsPort = 8000;
const wss = new WebSocket.Server({ port: wsPort });
const clientes = [];

wss.on("connection", (ws) => {
    console.log("Cliente conectado");

    ws.on("message", (message) => {
        console.log(clientes);
        if (message.includes("Name:")) {
            const nombre = message.toString().split(":");
            clientes.push({
                "name": nombre[1],
                "socket": ws
            });
            ws.send(`${nombre[1]} te has conectado al servidor`);
            console.log("Cliente conectado:", message.toString());
        } else {

            let clienteConectado = {};
            clientes.forEach(cliente => {
                if (ws === cliente.socket) {
                    clienteConectado = cliente.name;
                    console.log(`Mensaje recibido de ${cliente.name}: ${message.toString()}`);
                }
            });

            let mensaje = `${clienteConectado}: ${message.toString()}`

            clientes.forEach(cliente => {
                cliente.socket.send(mensaje);
            });
        }


    });


    ws.send("Bienvenido al servidor WebSocket");
});

console.log(`Servidor WebSocket escuchando en ws://localhost:${wsPort}`)