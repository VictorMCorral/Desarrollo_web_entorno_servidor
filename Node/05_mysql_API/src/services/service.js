const fs = require('fs');
const path = require('path');

const database = require("../config/database");
const repository = require("../repositories/depart.repository");

async function getEmples() {
    return repository.getEmples();
}

async function addEmple(newEmple) {
    return repository.addEmple(newEmple);
}

async function updateEmple(newEmple) {
    return repository.updateEmple(newEmple);
}

async function deleteEmple(emple_no) {
    return repository.deleteEmple(emple_no);
}



module.exports = {
    getEmples,
    addEmple,
    updateEmple,
    deleteEmple
};
