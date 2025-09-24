console.log('Hola mundo de Victor M. 2');
const http= require('http');

const server = http.createServer((req,res) => {
    res.end('<h1>Hola mundo Victor M. Corral 2</h1>')
})

server.listen(3001);