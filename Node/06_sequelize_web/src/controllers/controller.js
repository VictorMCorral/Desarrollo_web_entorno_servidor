const path = require('path');
// const ejs = require('ejs');
const userService = require('../services/service');
//TODO cambiar res por render, descomentar const ejs
function home(req, res) {
    const users = userService.getUsers();
    res.writeHead(200, { "Content-Type": "application/json" });
    res.end(users);
}

async function getEmples(req, res) {
    const emples = await userService.getEmples();
    console.log(emples);
    res.writeHead(201, { "Content-Type": "application/json" })
    res.end(JSON.stringify({ emples }));
}

function addEmple(req, res) {
    let body = "";
    let newEmple = null;

    req.on("data", (chunck) => {
        body += chunck.toString();
    });

    req.on("end", async () => {
        newEmple = await JSON.parse(body);
        let estado = await userService.addEmple(newEmple);
        if (estado) {
            res.writeHead(201, { "Content-Type": "application/json" })
            res.end(JSON.stringify({ message: "User added", user: newEmple }));
        }
    })
}

async function deleteEmple(req, res, emple_no) {
    const estado = await userService.deleteEmple(emple_no);
    if (estado) {
        res.writeHead(201, { "Content-Type": "application/json" })
        res.end(JSON.stringify({ message: "User delete", user: emple_no }));
    }
}

async function updateEmple(req, res) {

    let body = "";
    let newEmple = null;

    req.on("data", (chunck) => {
        body += chunck.toString();
    });

    req.on("end", async () => {
        newEmple = await JSON.parse(body);
        const estado = await userService.updateEmple(newEmple);
        if (estado) {
            res.writeHead(201, { "Content-Type": "application/json" })
            res.end(JSON.stringify({ message: "User added", user: newEmple }));
        }
    })
}



module.exports = {
    home,
    getEmples,
    addEmple,
    deleteEmple,
    updateEmple
};
