<html>
	<head>
		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<title>小劍獅一起來註冊!</title>
		<script src="script.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>

	<body>
		<div class="pic"></div>
		<div class="pic2"></div>
		<div class="container">
			<div class="navBar">
				<h class="navBar__title">いらっしゃいませ！歡迎光臨~★★★</h>
			</div>
			<div class="comment-display">
				<form class="comment__form login" action="register_checking.php" method="POST">
					帳號 account :  <input class="inputarea" name="usernames" type="text" /><br>
					密碼 password :  <input class="inputarea" name="passwords" type="password" /><br>
					暱稱 nickname :  <input class="inputarea" name="nickname" type="text">
					<div class="buttoncenter">
						<input type="submit" class="button__2" value="註冊起來!"/>
						<button class="button__2"><a href="login.php">我已經有帳號了!</a></button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>