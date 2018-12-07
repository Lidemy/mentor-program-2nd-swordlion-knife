<?php
 // 開頭先判定有沒有登入 有登入的話存取 COOKIE 讓後面的 Mysql 使用去把 Certificate 跟 user 這兩個資料庫連結起來
	require('connection.php');
	
	$is_login = false;
	$user_id='';
	$user_nickname='';
	// 改成 session~
	if (isset($_COOKIE["member_id"]) && !empty($_COOKIE["member_id"])) {
		$is_login = true;
    	$user_id = $_COOKIE["member_id"];
    	$user_nickname = $_COOKIE["member_nickname"];
    } 
?>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<title>劍獅的留言小天地</title>
		<!-- 這邊是音樂 試過了各種元素 例如 audio 或是 embed 但就是沒一個能滿足我想要隱藏又能自動撥放+無限重複的 最後只能退而求其次用 iframe 能自動撥放隱藏 但是不能設定無限重複 -->
		<iframe src="1.mp3" allow="autoplay" style="display:none"></iframe>
		<!-- jquery -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<!-- 自己寫的除了 AJAX 之外 一些 click 或 網頁轉址的導向 -->
		<script type="text/javascript" src="javascript/script.js"></script>
		<!-- 這邊是 bootstrap 的引用 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<!-- bootswatch -->
		<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<!-- 自己寫的style 比較想知道 style要怎麼寫比較不會那麼雜 可能用sass scss 寫會比較好 這邊進度還沒跟上 感覺自己很多多餘的東西 有時候改一改可能前面根本不需要的就沒用擺在那邊 -->
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<!-- 留言的 AJAX -->
		<script method="jquery" src="javascript/ajax_comment.js"></script>
		<!-- 編輯的 AJAX -->
		<script method="jquery" src="javascript/ajax_edit.js"></script>
	</head>

	<body onload="ShowTime()">
		<div class='peoplenum'>
			<?php
			// 這邊想做一個到站人數的php
				// 蠻想知道這種連到上一個資料夾裡的檔案的話是只有這種 ../ 的寫法嗎
				require("../countpeople.php");
				$string = strlen($num);
				echo "已經有 ";
				for($i = 0;$i < $string; $i++) {
					$n = substr($num,$i,1);
					echo "<img class='countpeople' src=countpeople/Sketch00$n.gif />";
				}
				echo " 個小劍獅飄過~😊😊😊";;
			?>
		</div>
		<?php 
			// 這邊如果登入的話會有登出按鈕
			if($is_login) {
		?>
		<button class="btn btn-primary logout">登出</button>
		<?php
			}
		?>
		<!-- 這邊 pic__swordlion 引入右邊的獅子圖案 -->
		<div class="pic__swordlion"></div>
		<!-- 至中以及控制 max-width 的容器 -->
		<div class="container">
			<!-- 點這個到部落格 新加的 之前沒控制好寬度擋到登出按鈕 鬧了笑話 -->
			<div class="blog"><a class="blog__redirection" href='../blog/blog.php'>點我去劍獅的部落格!</a></div>
			<!-- 最上面的圖案 一樣有不太會控制圖片的問題 -->
			<div class="pic__liveBetter">
				<img src="picture/pic.gif" class="pic__liveBetter__inside"/>
			</div>
			<!-- 雖然說是 navBar 原本想做一條工具列的 但後面還是覺得沒這個需要 -->
			<div class="navBar">
				<h class="navBar__title">劍獅的小小留言板</h>
			</div>
			<!-- 這邊開始是跟留言有關的區域 -->
			<div class="comment">
				<?php
				// 如果沒登入主留言欄會顯示請登入
					if(!$is_login) {
				?>
						<div class="comment__sub">
							<div class="comment__sub__notlogin">
								<a href="login.php">登入以進行留言</a>
							</div>
						</div>
				<?php
				// 如果有登入主留言欄會顯示留言區塊
					} else {
				?>
				<form class="comment__form__create" action="add_comment.php" method="post">
					<div class="comment__icon">
						<?php
						// 這邊用登入給的身分證 去抓使用者 老實說這種寫法真是漏漏長QQ
							$stmt = $conn->prepare("SELECT * from swordlion_knife_users LEFT JOIN swordlion_knife_users_certificate ON swordlion_knife_users_certificate.username = swordlion_knife_users.username WHERE certificate = ?");
							$stmt-> bind_param("s", $_COOKIE["member_id"]);
							$stmt-> execute();
							$find = $stmt->get_result();
							$find1 = $find->fetch_assoc();
							// 我的 avatar 圖案是用 user_id 來做判斷的!
							echo "<img src=avatar/". ($find1['id'] % 9 + 1) . ".png class='comment__avatar' />";	
						?>
						<div class="comment__userinfo">
						<?php
							// 這邊是顯示現在使用者的 nickname
							echo "<div class='comment__nickname'>".$find1['nickname']."</div>";
						?>
						</div>
					</div>
					<!-- 判斷是不是主留言的依據 -->
					<input type="hidden" value="0" name="major">
					<!-- 輸入留言的 textarea -->
					<textarea class="comment__form__textarea" name="content" placeholder="今天在想什麼呢<3"></textarea>
					<!-- submit按鈕 -->
					<button type="submit" class="btn btn-primary createcomment">留言!</button>
				</form>
				<?php
					}
				?>
				</div>
			<?php
				// 上面是主留言的留言欄 接下來是下面的顯示留言的地方 跟副留言區塊
				require('comment.php');
			?>
			<hr>
			<!-- 這個是顯示日期的地方! -->
			<div id="showbox"></div>
		</div>
	</body>

</html>
