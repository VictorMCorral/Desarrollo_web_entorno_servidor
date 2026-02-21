const http = require('http');
const fs = require("fs");
const path = require("path");

const filePath = path.join(__dirname, "public", "users.json");

const server = http.createServer((req, res) => {
    const { method, url } = req;
    if (method === "GET" && url === "/api/users") {
        const data = fs.readFileSync(filePath, {encoding: "utf-8"});

        res.writeHead(200, { "Content-Type": "application/json" });
        res.end(data);

    } else if (method === "POST" && url === "/api/users") {
        let body = "";
        req.on("data", (chunck) => {
            body += chunck.toString();
        });

        req.on("end", () => {
            const newUser = JSON.parse(body);
            const data = fs.readFileSync(filePath, "utf-8");
            const users = JSON.parse(data);
            users.push(newUser);

            fs.writeFileSync(filePath, JSON.stringify(users))

            res.writeHead(201, { "Content-Type": "application/json" })
            res.end(JSON.stringify({ message: "User added", user: newUser }));
        })
    } else {
        res.writeHead(404, { "Content-Type": "application/json" })
        res.end(JSON.stringify({ message: "Route not found" }));
    }
});

server.listen(3000, "127.0.0.1", () => {
    console.log("Server runing at http://127.0.0.1:3000/")
})