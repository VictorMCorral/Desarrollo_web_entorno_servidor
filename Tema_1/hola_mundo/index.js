console.log('Hola mundo de Victor M.');
const http= require('http');

const server = http.createServer((req,res) => {
    res.end('<h1>Hola mundo Victor M. Corral</h1>')
})

server.listen(3000);