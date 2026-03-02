const pageController = require('../controllers/controller');

function gestionarRutas(req, res) {

    const [baseURL, id] = optenerDinamica(req)
    console.log(baseURL + " ==> " + id);


    if (req.method === 'GET' && req.url === '/emples') {
        return pageController.home(req, res);
    }
    if (req.method === 'GET' && req.url === '/emple/createForm') {
        return pageController.createForm(req, res);
    }
    if (req.method === 'POST' && req.url === '/emple/insert') {
        return pageController.insert(req, res);
    }
    if (req.method === 'GET' && baseURL === '/emple/updateForm' && id) {
        return pageController.updateForm(req, res, id);
    }
    if (req.method === 'POST' && baseURL === '/emple/update' && id) {
        return pageController.update(req, res, id);
    }
    if (req.method === 'GET' && baseURL === '/emple/delete' && id) {
        return pageController.deleteemple(req, res, id);
    }

    res.writeHead(404);
    res.end('Not found');
}


function optenerDinamica(req) {
    const partes = req.url.split("/")
    let baseurl = ""
    const id = partes.pop()
    if (!id || isNaN(Number(id))) {

        for (let i = 1; i < partes.length; i++) {
            baseurl = baseurl + "/" + partes[i]
        }
        return [baseurl + "/" + id, null]
    }

    for (let i = 1; i < partes.length; i++) {
        baseurl = baseurl + "/" + partes[i]
    }

    return [baseurl, Number(id)]
}

module.exports = {
    gestionarRutas
};

