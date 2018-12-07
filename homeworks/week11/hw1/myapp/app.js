const express = require('express')
const session = require('express-session')
const bodyParser = require('body-parser')
const app = express()

app.use(session({secret:'swordlion',cookie:{maxAge:60000}}))
// 使用 public 這個資料夾裡的東西
app.use(express.static('public'))
// view engine ejs 語法
app.set('view engine','ejs')
// 用來讀取表單
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended:true}))
app.use(session({
	cookie: {maxAge:600 * 1000}
}))

const User = require('./model/user')
const Post = require('./model/post')
const userController = require('./controller/user')

app.get('/',userController.index)
app.get('/login',userController.login)
app.post('/loginChecking',userController.loginChecking)
	//JSON.stringify(req.fields);
app.get('/register',userController.register)
app.post('/registerChecking',userController.registerChecking)
app.get('/logout',userController.logout)

app.get('/post')
app.post('/post',userController.post)
app.post('/subpost',userController.subpost)

app.listen(3000,() => {
	console.log('SUCCESS')
})