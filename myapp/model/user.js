const sequelize = require("sequelize")

module.exports = (sequelize,DataTypes) => {
	const Users = sequelize.define('user',{
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

	return Users
}