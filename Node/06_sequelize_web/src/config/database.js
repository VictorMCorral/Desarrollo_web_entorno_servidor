require("dotenv/config");
const { Sequelize, Op, Model, DataTypes } = require('@sequelize/core');
//TODO repasar

const sequelize = new Sequelize(
    process.env.DB_HOST, 
    process.env.DB_USER, 
    process.env.DB_DATABASE, 
    {
    host: process.env.DB_HOST,
    dialect: "mysql"
    } 
)

module.exports = sequelize