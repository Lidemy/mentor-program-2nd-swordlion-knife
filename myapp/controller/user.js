module.exports = {
	index:(req,res) => {
		res.render('index', {
			title: '劍獅的小小留言板',
			ejsinput: 'comment.ejs'
		})
	},
	login: (req,res) => {
		res.render('login')
	},
	loginChecking: (req,res) => {
		res.render('login')
	},
	register: (req,res) => {
		res.render('register')
	},
	registerChecking: (req,res) => {
		res.render('login')
	},
	logout: (req,res) => {
		req.session.destroy();
	}
}