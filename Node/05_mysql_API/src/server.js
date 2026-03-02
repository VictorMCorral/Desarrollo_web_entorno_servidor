const http = require("http");
const fs = require("fs");
const path = require("path");

const routes = require("./routes/routes");


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

    const partes = req.url.split("/");

    if(partes[1] === "users" && partes[2]){
        const id = partes[2];
        routes.gestionarRutasDinamicas(req, res, id);

    } else if(partes[1] === "users"){

        routes.gestionarRutas(req, res);
    } else {
        console.log("Ruta erronea")
    }

})

server.listen(3000, ()=> {
    console.log("Servidor en http://localhost:3000")
})