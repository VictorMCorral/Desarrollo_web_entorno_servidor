const path = require('path');
const ejs = require('ejs');
const service = require('../services/service');
const qs = require("querystring");



async function home(req, res) {
    const filePath = path.join(__dirname, '../views/home.ejs');

    try {
        const emple = await service.getEmples();
        ejs.renderFile(filePath, { title: 'Inicio', emple: emple || [] }, (err, html) => {
            if (err) {
                console.error('Error renderizando home.ejs:', err);
                res.writeHead(500, { 'Content-Type': 'text/plain; charset=utf-8' });
                return res.end('Error al renderizar la vista de empleados');
            }

            res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
            res.end(html);
        });
    } catch (error) {
        console.error('Error consultando empleados:', error);
        res.writeHead(500, { 'Content-Type': 'text/plain; charset=utf-8' });
        res.end('Error al consultar empleados en la base de datos');
    }
}

function createForm(req, res) {
    const filePath = path.join(__dirname, '../views/createForm.ejs');

    ejs.renderFile(filePath, { title: "Crear emple" }, (err, html) => {
        res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
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

    emple = await service.getEmple(id)
    console.log(emple);

    ejs.renderFile(filePath, { title: "Update emple", emple: emple[0] }, (err, html) => {
        res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
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
        await service.editEmple(output.apellido, output.oficio, id)
        res.writeHead(301, { Location: "/" })
        res.end();
    });
}
async function deleteemple(req, res, id) {
    await service.deleteEmple(id)

    res.writeHead(301, { Location: "/" })
    res.end()
}



module.exports = { home, createForm, insert, updateForm, update, deleteemple };