const database = require("../config/database");

async function getEmples() {
    try {
        const [users] = await database.execute("SELECT * FROM emple");
        return users;
    } catch (error) {
        console.error("Error en la consulta:", error)
    }
}

async function addEmple(newEmple) {
    try {
        await database.execute(
            "INSERT INTO emple (emple_no, apellido, oficio, dept_no) VALUES (?, ?, ?, ?)",
            [newEmple.emple_no, newEmple.apellido, newEmple.oficio, newEmple.dept_no]);
        return true;
    } catch (error) {
        console.error("Error en la consulta:", error)
        return false;
    }
}

async function updateEmple(newEmple) {
    try {
        await database.execute(
            "UPDATE emple SET apellido=?, oficio=?, dept_no=? WHERE emple_no=?",
            [newEmple.apellido, newEmple.oficio, newEmple.dept_no, newEmple.emple_no]);
        return true;
    } catch (error) {
        console.error("Error en la consulta:", error)
        return false;
    }
}

async function deleteEmple(emple_no) {
    try {
        await database.execute(
            "DELETE FROM emple WHERE emple_no = ?",
            [emple_no]);
        return true;
    } catch (error) {
        console.error("Error en la consulta:", error)
        return false;
    }

}




module.exports = {
    getEmples,
    addEmple,
    updateEmple,
    deleteEmple
}