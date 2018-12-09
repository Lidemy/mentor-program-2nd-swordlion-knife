const db = require("../model/db")
const crypto = require("crypto")
module.exports = {
	index:(req,res) => {
		res.render('index', {
			shortUrl: '你的短網址會顯示在這裡喔!!'
		})
	},
	transform:(req,res) => {
		db.shortUrls.find({
			where: {
				longUrl:req.body.url
			}
		}).then((data) => {
			if(data) {
				res.render('index',{
					shortUrl:'你的短網址是' + data.shortUrl
				})
			} else {
				var longUrl = req.body.url
				var shortUrl = ShortenUrl(longUrl)
				console.log(shortUrl)
			}
		})
	}
}

ShortenUrl = (longUrl) => {
	var md5EncriptUrl = crypto.randomBytes(3).toString('hex')
	return md5EncriptUrl
}