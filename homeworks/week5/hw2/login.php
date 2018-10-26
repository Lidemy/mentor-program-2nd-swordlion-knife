<html>
	<head>
		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<title>小劍獅們來登入囉!</title>
		<script src="script.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>

	<body>
		<div class="pic2"></div>
		<div class="container">
			<div class="pic">
				<img src="pic.png" class="pic__inside"/>
			</div>
			<div class="navBar">
				<h class="navBar__title">お帰りなさい！歡迎回家~★★★</h>
			</div>
			<div class="comment-display">
				<form class="comment__form" action="login_checking.php" method="POST">
					帳號 account :   <input class="inputarea" name="usernames" type="text" /><br>
					密碼 password :  <input class="inputarea" name="passwords" type="password" />
					<div class="buttoncenter">
						<button type="submit" class="button__2">登入!</button>
						<button class="button__2"><a href="register.php">還沒有帳號嗎QQ</a></button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>