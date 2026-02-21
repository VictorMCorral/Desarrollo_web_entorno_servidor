const http = require("http");
const fs = require("fs");
const path = require("path");

const gestionarRutas = require("./routes/routes");
//TODO crear vistas web que tenga un listado de usuarios con partials Header y footer, que el body cambien dependiendo del navbar>
//TODO Listado get mostrando todos los user.
//TODO Agregar user mostrando formulario.
//TODO Agregar user Post redirigiendo al listado. 
const server = http.createServer((req, res) => {

    if(req.url.startsWith("/public")) {
        const filePath = path.join(__dirname, req.url);
        fs.readFileSync(filePath, (err, data) =>{
            if (err){
                res.writeHead(404);
                return res.end("File not foud");
            }

            res.writeHead(200);
            res.end(data);
        })
    }


    gestionarRutas(req, res);
})

server.listen(3000, ()=> {
    console.log("Servidor en http://localhost:3000")
})