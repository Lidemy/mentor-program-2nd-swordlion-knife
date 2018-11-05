<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<title>小劍獅一起來註冊!</title>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<script type="text/javascript" src="javascript/script.js"></script>
	</head>

	<body onload="ShowTime()">
		<div class="pic2"></div>
		<div class="container">
			<div class="pic">
				<img src="picture/pic.gif" class="pic__inside"/>
			</div>
			<div class="navBar">
				<h class="navBar__title">いらっしゃいませ！歡迎光臨~★★★</h>
			</div>
			<div class="comment-display">
				<form class="comment__form login" action="register_checking.php" method="POST">
					<div class="wrapping2">
						帳號 account :  <input class="inputarea" name="usernames" type="text" /><br>
						密碼 password :  <input class="inputarea" name="passwords" type="password" /><br>
						暱稱 nickname :  <input class="inputarea" name="nickname" type="text">
					</div>
					<div class="buttoncenter">
						<button type="submit" class="button__2 btn btn-outline-primary">註冊起來!</button>
						<button type="button" class="button__2 btn btn-outline-primary">我已經有帳號了!</button>
					</div>
				</form>
			</div>
			<div id="showbox"></div>
		</div>
	</body>
</html>