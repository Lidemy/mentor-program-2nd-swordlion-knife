<html>
	<head>
		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<title>劍獅Swordlion</title>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<link rel='stylesheet' href="style.css">
		<script type="text/javascript">
			ShowTime = () => {
			　	var Today = new Date();
				document.getElementById('showbox').innerHTML = Today.getFullYear() + " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日 , 今天開始加油吧😊";
				setTimeout('ShowTime()',3600*24);
			}
		</script>
	</head>

	<body onload='ShowTime()'>
		<div class='container'>
			<div class="pic2">
				<img src="commentboard/picture/swordlion.gif" class="pic__inside"/>
			</div>
			<div class="pic">
				<img src="commentboard/picture/pic.gif" class="pic__inside"/>
			</div>
			<div class='transform'>
				<div class='a'><a href='commentboard/index.php'>留言板</a></div>
				<div class='a'><a href='blog/blog.php'>部落格</a></div>
			</div>
			<div class='info'>點擊進入↑</div>
			<div id="showbox"></div>
		</div>
	</body>

</html>
