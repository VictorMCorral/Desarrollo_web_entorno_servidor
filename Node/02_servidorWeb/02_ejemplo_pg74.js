const http = require("http");
const fs = require("fs");
const fsPromises = require("fs/promises");
const path = require("path");
const qs = require("querystring");
const { buffer } = require("stream/consumers");


const server = http.createServer(async (req, res) => {
    if (req.method === "GET") {
        console.log("Metodo", req.method);
        console.log("Url ", req.url);
        switch (true) {
            case req.url === "/":
                const data = await fsPromises.readFile("./public/index.html", "utf-8");
                res.writeHead(200, { "content-type": "text/html" });
                res.end(data);
                break;
            case req.url === "/pideForm?":
                const dataForm = await fsPromises.readFile("./public/index_form.html", "utf-8");
                res.writeHead(200, { "content-type": "text/html" });
                res.end(dataForm);
                break;
            case /\.css$/.test(req.url):
                const cssPath = path.join(__dirname, "public", req.url);
                const streamcss = fs.createReadStream(cssPath, "utf-8");
                res.writeHead(200, { "content-type": "text/css" });
                streamcss.pipe(res);
                break;
            case /\.png$/.test(req.url):
                const pngPath = path.join(__dirname, "public", req.url);
                const streampng = fs.createReadStream(pngPath);
                res.writeHead(200, { "content-type": "image/png" });
                streampng.pipe(res);
                break;
            case /\.ico$/.test(req.url):
                const icoPath = path.join(__dirname, "public", req.url);
                const streamico = fs.createReadStream(icoPath);
                res.writeHead(200, { "content-type": "image/ico" });
                streamico.pipe(res);
                break;
            default:
                res.writeHead(400, { "content-type": "text/plain" });
                res.end("404 Not Found")
        }
    } else if (req.method === "POST") {
        // let body = ``
        let body = [];

        req.on("data", chunck => {
            // body += chunck;
            body.push(chunck);
        })

        req.on("end", () => {
            const data = Buffer.concat(body);
            // let objeto = qs.parse(body);
            let objeto = qs.parse(data.toString());
            console.log();
            console.log("============= Respuesta =============")
            console.log(objeto);
            console.log();
            
            let estructuraHtml = `
                    <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link rel="stylesheet" href="estilos.css">
                            <title>Document</title>
                        </head>
                        <body>
                            <h1>DATOS</h1>
                            <h2>Nombre = ${objeto.prueba}</h2>
                            <h2>Email = ${objeto.email}</h2>                
                            <form action="/pideForm" method="get">
                                <input type="submit" value="acceder al formulario">
                            </form>
                        </body>
                    </html> 
                    `

            res.writeHead(200, { "content-type": "text/html" });
            res.end(estructuraHtml);
        })
    }
})

server.listen(3000, "localhost", () => {
    console.log("Servidor funcionando en el http://localhost:3000");
});