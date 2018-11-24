const Sequelize = require('sequelize')
const db = require('./db')

const User = db.define('user',{
	nickname: {
		type:Sequelize.STRING
	},
	username: {
		type:Sequelize.STRING
	},
	password: {
		type:Sequelize.STRING
	}
},{
	tableName:'swordlion_knife_express_users'
	});

User.sync()

module.exports = User;