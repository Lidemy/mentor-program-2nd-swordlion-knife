module.exports = (sequelize,DataTypes) => {
	const Users = sequelize.define('user',{
	nickname: {
		type:DataTypes.STRING
	},
	username: {
		type:DataTypes.STRING
	},
	password: {
		type:DataTypes.STRING
	}
},{
	tableName:'swordlion_knife_express_users'
	});
	Users.sync()

	return Users
}