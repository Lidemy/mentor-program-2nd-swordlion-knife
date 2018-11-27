module.exports = (sequelize,DataTypes) => {
	const Subposts = sequelize.define('subposts',{
	post_id: {
		type:DataTypes.INTEGER
	},
	content: {
		type:DataTypes.STRING
	}
},{
	underscored:true,
	tableName:'swordlion_knife_express_subposts'
	});
	Subposts.sync()

	return Subposts
}