const sequelize = require("sequelize")
const setting = require('./setting')

const Connection = new sequelize("mentor_program_db",'student2nd',setting.password, {
	host:'mentor-program.co',
	dialect:'mysql'
})


const db = {}
db.sequelize = sequelize
db.Connection = Connection

db.users = require('./user')
db.posts = require('./post')
db.subposts = require('./subpost')

db.posts.belongsTo(db.users)
db.users.hasMany(db.posts)

db.subposts.belongsTo(db.posts)
db.posts.hasMany(db.subposts)

module.exports = db

