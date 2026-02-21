const fs = require('fs');
const path = require('path');

const dataPath = path.join(__dirname, '../data/users.json');

function readUsers() {
    const data = fs.readFileSync(dataPath, 'utf8');
    return JSON.parse(data);
}


function getUsers() {
    return readUsers();
}

function addUser(newUser) {
    const data = fs.readFileSync(dataPath, "utf-8");
    const users = JSON.parse(data);
    users.push(newUser);
    fs.writeFileSync(dataPath, JSON.stringify(users))

}



module.exports = {
    getUsers,
    addUser
};
