const db = require("../repositories/emple.repository");

async function getEmples() {
    return await db.getEmples();
}

async function addEmple(dnombre, loc) {
    return await db.addEmple(dnombre, loc);
}
async function getEmple(Emple_no) {
    return await db.getEmple(Emple_no);
}
async function editEmple(Emple_no, dnombre, loc) {
    return await db.editEmple(Emple_no, dnombre, loc);
}
async function deleteEmple(Emple_no) {
    return await db.deleteEmple(Emple_no);
}





module.exports = {
    getEmples, addEmple, getEmple, editEmple, deleteEmple
};
