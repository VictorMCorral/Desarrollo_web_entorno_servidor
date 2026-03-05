const sequelize = require("../config/database");
const { Sequelize } = require("sequelize");

const Emple = sequelize.define('emple', {
    emple_no: {
        field: 'EMPLE_no',
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
        field: 'DEPART_no',
        type: Sequelize.INTEGER,
        allowNull: true
    }
}, {
    tableName: 'emple',
    freezeTableName: true,
    timestamps: false
});

module.exports = Emple;