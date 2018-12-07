module.exports = (sequelize,DataTypes) => {
	const shortUrl = sequelize.define('shortUrls',{
	longUrl: {
		type:DataTypes.STRING,
	},
	shortUrl: {
		type:DataTypes.STRING
	},
},{
	underscored:true,
	tableName:'swordlion_knife_shortUrl'
	});
	shortUrl.sync()
	return shortUrl
}