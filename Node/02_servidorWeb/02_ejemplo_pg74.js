const http = require("http");
const fs = require("fs");
const fsPromises = require("fs/promises");
const path = require("path");


const server = http.createServer(async (req, res) => {
    if(req.method === "GET"){
        console.log("Metodo", req.method);
        console.log("Url ", req.url);
        switch (true) {
            case req.url === "/":
                const data = await fsPromises.readFile("./public/index_form.html", "utf-8");
                res.writeHead(200, { "content-type": "text/html" });
                res.end(data);
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
                res.writeHead(200, { "content-type": "text/png" });
                streampng.pipe(res);
                break;
            default:
                res.writeHead(400, { "content-type": "text/plain" });
                res.end("404 Not Found")
        }
    } else if (req.method === "POST"){
        let body = "";

        req.on("data", chunck =>{
            body += chunck;
        })

        req.on("end", () => {
            res.end(body);
        })
    }
})

server.listen(3000, "localhost", () => {
    console.log("Servidor funcionando en el http://localhost:3000");
});