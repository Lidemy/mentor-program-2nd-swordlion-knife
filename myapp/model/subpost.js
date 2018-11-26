const sequelize = require("sequelize")

module.exports = (sequelize,DataTypes) => {
	const Subposts = sequelize.define('subposts',{
	post_id: {
		type:Sequelize.INTEGER
	},
	content: {
		type:Sequelize.STRING
	}
},{
	tableName:'swordlion_knife_express_subposts'
	});
	Subposts.sync()

	return Subposts
}