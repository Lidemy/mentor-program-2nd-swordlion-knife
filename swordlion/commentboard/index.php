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
		<title>劍獅的留言小天地</title>
		<iframe src="1.mp3" allow="autoplay" style="display:none"></iframe>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="javascript/script.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<script method="jquery" src="javascript/ajax_comment.js"></script>
		<script method="jquery" src="javascript/ajax_edit.js"></script>
	</head>

	<body onload="ShowTime()">
		<div class='peoplenum'>
			<?php
				require("../countpeople.php");
				$string = strlen($num);
				echo "你是第 ";
				for($i = 0;$i < $string; $i++) {
					$n = substr($num,$i,1);
					echo "<img class='countpeople' src=countpeople/Sketch00$n.gif />";
				}
				echo " 位到來的小劍獅";;
			?>
		</div>
		<?php 
			if($is_login) {
		?>
		<button class="btn btn-primary logout"><a href="logout.php">登出</a></button>
		<?php
			}
		?>
		<div class="toblog"><a class="toblog__a" href='../blog/index.php'>點我去劍獅的部落格!</a></div>
		<div class="pic2"></div>
		<div class="container">
			<div class="pic">
				<img src="picture/pic.gif" class="pic__inside"/>
			</div>
			<div class="navBar">
				<h class="navBar__title">劍獅的小小留言板</h>
			</div>
			<div class="comment-display">
				<?php
				// 如果沒登入主留言欄會顯示登入
					if(!$is_login) {
				?>
						<div class="sub-list">
							<div class="comment-display__login adding">
								<a href="login.php" class="button">登入以進行留言</a>
							</div>
						</div>
				<?php
				// 如果有登入主留言欄會顯示留言區塊
					} else {
				?>
				<form class="comment__form" action="add_comment.php" method="post">
					<div class="comment__form__icon">
						<?php
							$stmt = $conn->prepare("SELECT * from swordlion_knife_users LEFT JOIN swordlion_knife_users_certificate ON swordlion_knife_users_certificate.username = swordlion_knife_users.username WHERE certificate = ?");
							$stmt-> bind_param("s", $_COOKIE["member_id"]);
							$stmt-> execute();
							$find = $stmt->get_result();
							$find1 = $find->fetch_assoc();
							echo "<img src='avatar/". $find1['id'] % 9 .".png' class='comment__form__icon__avatar' />";	
						?>
						<div class="comment__form__icon__userinformation">
						<?php
							echo "<div class='comment__form__icon__userinformation__username'>".$find1['nickname']."</div>";
						?>
						</div>
					</div>
					<input type="hidden" value="0" name="major">
					<textarea class="comment__form__textarea" name="content" placeholder="今天在想什麼呢<3"></textarea>
					<button type="submit" class="btn btn-primary createcomment">留言!</button>
				</form>
				<?php
					}
				?>
				</div>
			<?php
				require('comment.php');
			?>
			<hr>
			<div id="showbox"></div>
		</div>
	</body>

</html>
