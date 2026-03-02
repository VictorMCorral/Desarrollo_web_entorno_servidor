const pageController = require('../controllers/controller');

function gestionarRutas(req, res) {

    if (req.method === 'GET' && req.url === '/users') {
        return pageController.getEmples(req, res);
    }

    if (req.method === 'POST' && req.url === '/users') {
        return pageController.addEmple(req, res);
    }

    res.writeHead(404);
    res.end('Not found');
}

function gestionarRutasDinamicas(req, res, id) {
    if (req.method === "DELETE") {
        return pageController.deleteEmple(req, res, id);
    }
    if (req.method === "PUT") {
        return pageController.updateEmple(req, res);
    }
}

module.exports = {
    gestionarRutas,
    gestionarRutasDinamicas
};

