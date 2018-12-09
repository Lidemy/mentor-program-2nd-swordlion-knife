const express = require('express')
const bodyParser = require('body-parser')
const userController = require('./controller/controller')
const app = express()

app.set('view engine','ejs')
app.use(express.static('public'))
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended:true}))

app.get("/",userController.index)
app.post("/transform",userController.transform)

app.listen(3000,() => {
	console.log('SUCCESS')
})
