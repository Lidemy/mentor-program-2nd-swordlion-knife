const sequelize = require("sequelize")
const setting = require('./setting')

const sequelize = new Sequelize("mentor_program_db",'huli',setting.password, {
	host:'166.62.28.131',
	dialect:'mysql'
})

sequelize
	.authenticata()
	.then(() => {
		console.log("connection success")
	})
	.catch(err => {
		console.error("connection fail")
	});

module.exports = sequelize

