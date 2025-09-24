console.log('Hola mundo docker')
const http= require('http');

const server = http.createServer((req,res) => {
    console.log('Revisa el explorador, recuerda: "localhost:3000"')
    res.end('Hola mundo en explorador')
})

server.listen(3000, "0.0.0.0", () => {
    console.log('Arrancando servidor por el puerto 3000...')
})