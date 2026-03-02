const dgram = require("dgram");
const server = dgram.createSocket("udp4");


server.on("message", (msg, rinfo) => {
    console.log(`Servidor recibió: ${msg} desde ${rinfo.address}:${rinfo.port}`);
    let mensajeUP = msg.toString().toUpperCase();
    if(msg == "*") mensajeUP = "*";
    
    const response = Buffer.from(mensajeUP);
    server.send(response, rinfo.port, rinfo.address, (error) => {
        if (error) {
            console.error(`Error al enviar la repsuesta`, error);
        } else {

            console.log("Respuesta enviada al cliente");
        }
    });
});

server.on(`listening`, () => {
    const address = server.address();
    console.log(`Servidor UDP iniciado en ${address.address}:${address.port}`);
});



server.on("error", (err) => {
    console.error(`Error en servidor UDP:`, err);
    server.close();
});


server.bind(4123, () => {
    console.log(`Servidor UDP esta escuchando en el puerto 4123`)
})
