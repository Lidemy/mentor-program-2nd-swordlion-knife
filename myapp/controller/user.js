const db = require('../model/db')
var trigger = 0;
module.exports = {
	index:(req,res) => {
		db.user.findAll({
			include: [
				{
					model:db.post,
					include: [
						{
							model:db.subpost
						}
					]
				}
			]
		}).then(users => {
			const resObj = users.map(user => {
				return Object.assign(
					{},
					{
						user_id:user.id,
						username:user.username,
						nickname:user.nickname,
						posts:user.posts.map(post => {
							return Object.assign(
								{},
								{
									post_id:post.id,
									user_id:post.user_id,
									content:post.content,
									subpost:post.subposts.map(subpost => {
										return Object.assign(
										{},
										{
											subpost_id:subpost.id,
											post_id:subpost.post_id,
											content:subpost.content
										})
									})
								})
						})
					})
			})
			res.json(resObj)
			console.log(resObj)
			res.render('index', {
				title: '劍獅的小小留言板',
				ejsinput: 'comment.ejs',
				resObj,
				username: (req.session.username) ? req.session.username : "訪客請先登入"
			})
		})
	},
	login: (req,res) => {
		res.render('index', {
			title: 'お帰りなさい！歡迎回家~★★★',
			ejsinput: 'login.ejs'
		})
	},
	loginChecking: (req,res) => {
		User.find({
			where: {
				username: req.body.usernames,
				password: req.body.passwords
			}
		}).then(data => {
			if(data) {
				req.session.id = data.id
				req.session.username = data.username
				req.session.nickname = data.nickname
				res.redirect('/')
			} else {
				res.redirect('/login')
			}
		}).catch((err) => {
			res.redirect('/login')
		}) 
	},
	register: (req,res) => {
		res.render('index', {
			title: 'いらっしゃいませ！歡迎光臨~★★★',
			ejsinput: 'register.ejs',
			error:(trigger == 0) ? false : true
		})
	},
	registerChecking: (req,res) => {
		User.find({
			where: {
				username: req.body.usernames
			}
		}).then((data)=> {
			if(data) {
				trigger = 1;
				res.redirect('/register')
			} else {
				User.create({
					nickname: req.body.nickname,
					username: req.body.usernames,
					password: req.body.passwords
				}).then(() => {
					req.session.id = data.id
					req.session.username = req.body.usernames
					req.session.nickname = req.body.nicknames
					res.redirect('/')
				})
			}
		}).catch((err) => {
			res.redirect('/register')
		})
	},
	post:(req,res) => {
		User.find({
			where: {
				username: req.session.username
			}
		}).then((data) => {
			if(data) {
				Post.create({
					major: req.body.major,
					user_id: data.id,
					content: req.body.content
				})
				res.redirect('/')
			}
		}).catch((err) => {
			console.log(err)
			res.redirect('/')
		})
	},
	subpost:(req,res) => {
		User.find({
			where: {
				username:req.session.username
			}
		}).then((data) => {
			subPost.create({
				major,
			})
		})
	},
	logout: (req,res) => {
		req.session.destroy()
		res.redirect('/')
	}
}