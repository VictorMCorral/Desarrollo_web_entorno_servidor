const pageController = require('../controllers/controller');

function gestionarRutas(req, res) {

    if (req.method === 'GET' && req.url === '/users') {
        return pageController.users(req, res);
    }

    if (req.method === 'POST' && req.url === '/users') {
        return pageController.usersPost(req, res);
    }

    res.writeHead(404);
    res.end('Not found');
}

module.exports = gestionarRutas;

