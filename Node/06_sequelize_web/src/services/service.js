const db = require("../repositories/emple.repository");

async function getEmples() {
    return await db.getEmples();
}

async function addEmple(newEmple) {
    return await db.addEmple(newEmple);
}
async function getEmple(Emple_no) {
    return await db.getEmple(Emple_no);
}
async function editEmple(apellido, oficio, Emple_no) {
    return await db.editEmple({ apellido, oficio, emple_no: Emple_no });
}
async function deleteEmple(Emple_no) {
    return await db.deleteEmple(Emple_no);
}





module.exports = {
    getEmples, addEmple, getEmple, editEmple, deleteEmple
};
