const { Socket } = require("dgram");
const http = require("http");
const { Server } = require("socket.io");

const clients = [];
let contador = 1;

const server = http.createServer((req, res) => {
    res.writeHead(200, { "Content-Type": "text/html" });
    res.end(`<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Cliente Socket.IO sin Express</h1>
    <input type="text" id="messageInput" placeholder="Escribe un mensaje...">
    <button id="sendButton">Enviar mensaje</button>
    <br><br>
    <textarea rows="20" cols="50" name="chatsMessages" id="chatsMessages"></textarea>

    <script src="/socket.io/socket.io.js"></script>
    <script>
        const socket = io();
        const chat = document.getElementById("chatsMessages");


        document.getElementById("sendButton").onclick = function () {
            const mensaje = document.getElementById("messageInput").value;
            socket.emit("mensaje", mensaje);
        };

        socket.on("respuesta", function (data) {
            let texto = chat.value;
            texto += "\\n" + data;

            chat.value = texto;
            console.log("Respuesta del servidor:", data);
        });

    </script>
</body>

</html>`
    );
});

const io = new Server(server);

io.on("connection", (socket) => {
    const cliente = {
        "name": `${contador}`,
        "socket": socket,
        "room": "Sala 1"
    }
    if(clients.some(p => p.name !== cliente.name)) clients.push(cliente)

    contador++;
    socket.join("Sala 1");

    console.log("Un cliente se ha conectado");

    socket.on("mensaje", (msg) => {
        clients.forEach(client => {
            console.log("Cliente-" + client.name);
        });
        console.log("Mensaje recibido del cliente:", msg);
        socket.to("Sala 1").emit(`${cliente.name}:${msg}`);
    });

    socket.on("disconnect", () => {
        console.log("Cliente desconectado")
    });
});

server.listen(3000, () => {
    console.log("Servidor corriendo en http://localhost:3000")
});