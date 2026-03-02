const http = require("http");
const fsPromises = require("fs/promises");
const path = require("path");



const server = http.createServer(async (req, res) => {
    // res.setHeader("Access-Control-Allow-Origin", "*");
    // res.setHeader("Access-Control-Allow-Methods", "GET");
    // res.setHeader("Access-Control-Allow-Headers", "Content-Type");

    if(req.url === "/"){
        const data = await fsPromises.readFile("./Cliente.html", "utf-8");
        res.writeHead(200, { "content-type": "text/html" });
        res.end(data);

    } else if (req.url === "/SSE"){
        res.writeHead(200, {
            "Content-Type": "text/event-stream",
            "Cache-Control": "no-cache",
            connection: "keep-alive",
        });
        
        const sendEvent = () => {
            const eventData = `data: ${new Date().toLocaleTimeString()}\n\n`
            res.write(eventData);
        };
        
        const intervalId = setInterval(sendEvent, 2000);
        
        req.on("close", () => {
            clearInterval(intervalId);
        });
        
    }
    




});

server.listen(3000, () => {
    console.log("Servidor SSE escuchando en http://localhost:3000")
})