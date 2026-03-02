const sequelize = require("../config/database");
const { Sequelize } = require("sequelize");

const Emple = sequelize.define('emple', {
    emple_no: {
        type: Sequelize.INTEGER,
        allowNull: false,
        primaryKey: true
    },
    apellido: {
        type: Sequelize.STRING,
        allowNull: true
    },
    oficio: {
        type: Sequelize.STRING,
        allowNull: true
    },
    dept_no : {
        type: Sequelize.INTEGER,
        allowNull: true
    }
}, {
    freezeTableName: true,
    timestamps: false
});

module.exports = Emple;