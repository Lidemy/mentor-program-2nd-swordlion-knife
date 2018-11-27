const sequelize = require("sequelize")
const setting = require('./setting')

const Connection = new sequelize("mentor_program_db",'student2nd',setting.password, {
	host:'mentor-program.co',
	dialect:'mysql'
})

Connection
	.authenticate()
	.then(() => {
		console.log("success")
	})
	.catch(err => {
		console.error("connection fail")
	});
	
const db = {}
db.sequelize = sequelize
db.Connection = Connection

db.users = require('./user')(Connection, sequelize)
db.posts = require('./post')(Connection, sequelize)
db.subposts = require('./subpost')(Connection, sequelize)

db.posts.belongsTo(db.users)
db.users.hasMany(db.posts)

db.subposts.belongsTo(db.posts)
db.posts.hasMany(db.subposts)

module.exports = db

