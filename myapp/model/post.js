const sequelize = require("sequelize")

module.exports = (sequelize,DataTypes) => {
	const Posts = sequelize.define('posts',{
	user_id: {
		type:Sequelize.INTEGER
	},
	content: {
		type:Sequelize.STRING
	}
},{
	tableName:'swordlion_knife_express_posts'
	});
	Posts.sync()

	return Posts
}