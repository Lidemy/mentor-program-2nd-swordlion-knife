<?php
	require('connection.php');
	
	$is_login = false;
	$user_id='';

	if (isset($_COOKIE["member_id"]) && !empty($_COOKIE["member_id"])) {
		$is_login = true;
    	$user_id = $_COOKIE["member_id"];
    } 
?>

<html>
	<head>
		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<title>劍獅的留言小天地</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>

	<body>
		<div class="pic"></div>
		<button class="logout"><a href="logout.php">登出</a></button>
		<div class="pic2"></div>
		<div class="container">
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
					<input type="submit" class="button createcomment" value="留言!" />
				</form>
				<?php
					}
				?>
				</div>
			<?php
				require('comment.php');
			?>
		</div>
				</div>


	</body>

</html>
