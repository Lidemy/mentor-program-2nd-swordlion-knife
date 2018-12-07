const sequelize = require("sequelize")
const setting = require('./setting')

const Connection = new sequelize("mentor_program_db",'student2nd',setting.password, {
	host:'mentor-program.co',
	dialect:'mysql',
	define: {
		underscored:true
	}
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

db.shortUrls = require('./shortUrls')(Connection, sequelize)

module.exports = db

