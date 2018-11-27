module.exports = (sequelize,DataTypes) => {
	const Posts = sequelize.define('posts',{
	user_id: {
		type:DataTypes.INTEGER,
	},
	content: {
		type:DataTypes.STRING
	}
},{
	underscored:true,
	tableName:'swordlion_knife_express_posts'
	});
	Posts.sync()
	return Posts
}