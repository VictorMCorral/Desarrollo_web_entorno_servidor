const path = require('path');
// const ejs = require('ejs');
const userService = require('../services/service');

function home(req, res) {
    const users = userService.getUsers();
    res.writeHead(200, { "Content-Type": "application/json" });
    res.end(users);
}

function users(req, res) {

}

function usersPost(req, res) {
    let body = "";
    let newUser = null;

    req.on("data", (chunck) => {
        body += chunck.toString();
    });

    req.on("end", async () => {
        newUser = await JSON.parse(body);       
        userService.addUser(newUser);
        res.writeHead(201, { "Content-Type": "application/json" })
        res.end(JSON.stringify({ message: "User added", user: newUser }));
    })

}

module.exports = { home, users, usersPost };
