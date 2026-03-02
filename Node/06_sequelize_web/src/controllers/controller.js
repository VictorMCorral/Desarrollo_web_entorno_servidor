const path = require('path');
const ejs = require('ejs');
const service = require('../services/service');
const qs = require("querystring");



async function home(req, res) {
    const filePath = path.join(__dirname, '../views/home.ejs');

    const emple = await service.getEmples();

    console.log("CORRECTO", emple)
    
    ejs.renderFile(filePath, { title: 'Inicio', emple }, (err, html) => {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        console.log(html);
        res.end(html);
    });
}

function createForm(req, res) {
    const filePath = path.join(__dirname, '../views/createForm.ejs');

    ejs.renderFile(filePath, { title: "Crear emple" }, (err, html) => {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.end(html);
    });
}

function insert(req, res) {
    const chunks = [];

    req.on('data', (chunk) => {
        chunks.push(chunk); //cada chunk leído es un buffer
    });

    req.on('end', async () => {
        const data = Buffer.concat(chunks); // Une varios buffers en uno solo
        const output = qs.parse(data.toString());
        await service.addEmple(output)
        res.writeHead(301, { Location: "/" })
        res.end();
    });
}
async function updateForm(req, res, id) {
    const filePath = path.join(__dirname, '../views/updateForm.ejs');

    emple = await service.getemple(id)
    console.log(emple);

    ejs.renderFile(filePath, { title: "Update emple", emple: emple[0] }, (err, html) => {
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.end(html);
    });
}
function update(req, res, id) {
    const chunks = [];

    req.on('data', (chunk) => {
        chunks.push(chunk); //cada chunk leído es un buffer
    });

    req.on('end', async () => {
        const data = Buffer.concat(chunks); // Une varios buffers en uno solo
        const output = qs.parse(data.toString());
        await service.editemple(id, output.dnombre, output.loc)
        res.writeHead(301, { Location: "/" })
        res.end();
    });
}
async function deleteemple(req, res, id) {
    await service.deleteemple(id)

    res.writeHead(301, { Location: "/" })
    res.end()
}



module.exports = { home, createForm, insert, updateForm, update, deleteemple };