const express = require('express')
const session = require('express-session')
const bodyParser = require('body-parser')
const app = express()

app.use(session({secret:'swordlion',cookie:{maxAge:60000}}))
app.use(express.static('public'))
app.set('view engine','ejs')
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended:true}))

const User = require('./model/user')
const userController = require('./controller/user')

app.get('/',userController.index)
app.get('/login',userController.login)
app.post('/loginChecking',(req,res) => {
	console.log(JSON.stringify(req.fields))
})
app.get('/register',userController.register)

app.listen(3000,() => {
	console.log('SUCCESS')
})