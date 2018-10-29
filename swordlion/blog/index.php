<?php
	require('connection.php');
	
	$is_login = false;
	$user_id='';
	$user_nickname='';

	if (isset($_COOKIE["member_id"]) && !empty($_COOKIE["member_id"])) {
		$is_login = true;
    	$user_id = $_COOKIE["member_id"];
    	$user_nickname = $_COOKIE["member_nickname"];
    } 
?>

<html>
	<head>
		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<title>劍獅的小部落格</title>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="javascript/script.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript">
			ShowTime = () => {
			　	var Today = new Date();
				document.getElementById('showbox').innerHTML = Today.getFullYear() + " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日 , 今天開始加油吧😊";
				setTimeout('ShowTime()',3600*24);
			}
		</script>
	</head>

	<body onload='ShowTime()'>
		<div class='peoplenum'>
			<?php
				require("../countpeople.php");
				$string = strlen($num);
				echo "你是第 ";
				for($i = 0;$i < $string; $i++) {
					$n = substr($num,$i,1);
					echo "<img class='countpeople' src=../commentboard/countpeople/Sketch00$n.gif />";
				}
				echo " 位到來的小劍獅";;
			?>
		</div>
		<div class="tocommentboard"><a class="tocommentboard__a" href='/swordlion/index.php'>點我去劍獅的留言板!</a></div>
		<div class="pic2"></div>
		<div class="container">
			<div class="pic">
				<img src="../commentboard/picture/pic.gif" class="pic__inside"/>
			</div>
			<div class="navBar">
				<h class="navBar__title">劍獅的小小部落格</h>
			</div>
			
			<div id="showbox"></div>
		</div>
	</body>

</html>
