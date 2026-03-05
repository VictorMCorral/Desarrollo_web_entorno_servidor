const Emple = require("../models/emple.model");

//TODO modificar consultas para sequelize
async function getEmples() {
    try {
        const usersArray = []
        const users = await Emple.findAll();

        users.forEach(emple => {
            // console.log(emple.dataValues)
            usersArray.push(emple.dataValues);
        });
        return usersArray;
    } catch (error) {
        console.error("Error en la consulta:", error)
    }
}

async function getEmple(emple_no) {
    try {
        const emple = await Emple.findAll({
            where: { emple_no: emple_no }
        });
        return emple;
    } catch (error) {
        console.error("Error en la consulta:", error)
    }
}

async function addEmple(newEmple) {
    try {
        const [rows] = await Emple.create({
            emple_no: Number(newEmple.emple_no),
            apellido: newEmple.apellido,
            oficio: newEmple.oficio,
            dept_no: Number(newEmple.dept_no)
        })
        return rows;
    } catch (error) {
        console.error("Error en la consulta:", error)
        return null;
    }
}

async function editEmple(newEmple) {
    try {
        const [rows] = await Emple.update({
            apellido: newEmple.apellido,
            oficio: newEmple.oficio,
        }, {
            where: { emple_no: newEmple.emple_no}
        });
        return rows;
    } catch (error) {
        console.error("Error en la consulta:", error)
        return null;
    }
}

async function deleteEmple(emple_noDelete) {
    try {
        const rows = await Emple.destroy({
            where: {emple_no: emple_noDelete}
        })
        console.log("Filas eliminadas: " + rows);
        return rows;
    } catch (error) {
        console.error("Error en la consulta:", error)
        return null;
    }

}

module.exports = {
    getEmples,
    addEmple,
    getEmple,
    editEmple,
    deleteEmple
}