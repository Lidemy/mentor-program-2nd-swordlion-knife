<?php
	require('connection.php');
	
	$is_login = false;
	$user_id='';
	$user_nickname='';

	if (isset($_COOKIE["member_id"]) && !empty($_COOKIE["member_id"])) {
		$is_login = true;
    	$user_nickname = $_COOKIE["member_nickname"];
    	$stmt = $conn->prepare("SELECT * from swordlion_knife_users LEFT JOIN swordlion_knife_users_certificate ON swordlion_knife_users_certificate.username = swordlion_knife_users.username WHERE certificate = ?");
		$stmt-> bind_param("s", $_COOKIE["member_id"]);
		$stmt-> execute();
		$find = $stmt->get_result();
		$find1 = $find->fetch_assoc();
		$user_id = $find1['id'];
    } 
?>

<html>
	<head>
		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		<title>劍獅的小部落格</title>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src='emoji/emoji.js'></script>
		<script type="text/javascript" src='script.js'></script>
		<script type="text/javascript" src='ajax_edit.js'></script>
	</head>

	<body onload='ShowTime()'>
		<div class='peoplenum'>
		<?php
			require("../countpeople.php");
			$string = strlen($num);
			echo "這個網站已經有 ";
			for($i = 0;$i < $string; $i++) {
				$n = substr($num,$i,1);
				echo "<img class='countpeople' src=countpeople/Sketch00$n.gif />";
			}
			echo " 個小劍獅拜訪過囉";;
		?>
		</div>
		<?php 
			if($is_login) {
		?>
				<button class="btn btn-primary logout">登出</button>
		<?php
			}
		?>
		<div class="pic__swordlion"></div>
		<div class="container">
			<div class="commentBoard"><a class="commentBoard__redirection" href='../commentboard/index.php'>點我去劍獅的留言板!</a></div>
			<div class="pic__liveBetter">
				<img src="../commentboard/picture/pic.gif" class="pic__liveBetter__inside"/>
			</div>
			<div class="navBar">
				<h class="navBar__title">劍獅的小小部落格</h>
			</div>
			<?php
				if($is_login) {
			?>
				<button class='btn btn-primary create__article'>我要發文!</button>
				<button class='btn btn-primary back'>回到文章區</button>
			<?php
				} else {
			?>
			<button class='btn btn-primary loginBeforePost'><a href="login.php">發文前請先登入!</a></button>
			<?php
				}
			?>	
			<div class='pagecontainer'>
				<form class='create__article__form' method="POST" action='create__article.php'>
					<div>發表文章</div>
					<input name='title' class='create__title' placeholder="在這裡輸入標題" />
					<div class="dropdown">
						<button class="btn btn-dark dropdown-toggle createcomment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">😄
						</button>
						<div class="dropdown-menu main" aria-labelledby="dropdownMenuButton">
						</div>
					</div>
					<textarea name='content' class='create__content' placeholder="文章輸入區域"></textarea>
					<input name='major' type='hidden' value='0' / >
					<button type='submit' class='btn btn-primary create__submitButton'>送出文章</button>
				</form>
				<div class='article-list'>
					<?php
						require_once('connection.php');
						$pagenum = '';
						$URL='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
						$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						$pagenumcal = explode('article=',$actual_link);
						if(!isset($pagenumcal[1])) {
						// 沒有選定文章的話顯示全部文章縮減版
							$stmt = $conn->prepare("SELECT * FROM swordlion_knife_users LEFT JOIN swordlion_knife_article ON swordlion_knife_users.id = swordlion_knife_article.user_id WHERE major = 0 ORDER BY created_at DESC");
							$stmt->execute();
							$catch = $stmt->get_result();
							if($catch->num_rows > 0) {
								while($catching = $catch->fetch_assoc()) {
									$newcontent = '';
									if(strlen($catching['content']) > 100 ) {
										for($i = 0; $i < 100; $i++ ) {
											$newcontent .= $catching['content'][$i];
										}
									} else {
										$newcontent = $catching['content'];
									}
									$avatarid = $catching['id']%9+1;
					?>
							<div class='article'>
				              <div class='article__area'>
				                <div class='userDetail'>
				                  <div>
				                  	<?php echo "<img src=avatar/".$avatarid.".png class='userDetail__avatar' />" ?>
				                  </div>
				                  <div>
				                    <div class='userDetail__creater'><?php echo $catching['nickname'] ?></div>
				                    <div class='userDetail__created_at'><?php echo $catching['created_at'] ?></div>
				                  </div>
				                </div>
				                <h><?php echo $catching['title'] ?></h>
				                <p><?php echo nl2br(htmlspecialchars($newcontent,ENT_QUOTES,'UTF-8')) ?><a href=<?php echo $URL.'?article='.$catching['num'] ?> class='continue'>繼續閱讀...</a></p>
				              </div>
				            </div>
		            <?php
		            			}
							}
						} else {
						// 如果有選定文章的話顯示文章頁面
							$pagenum = $pagenumcal[1];
							$stmt = $conn->prepare("SELECT * FROM swordlion_knife_users LEFT JOIN swordlion_knife_article ON swordlion_knife_users.id = swordlion_knife_article.user_id  WHERE num = ?");
							$stmt->bind_param('s',$pagenum);
							$stmt->execute();
							$catch = $stmt->get_result();
							$catching = $catch->fetch_assoc();
							$avatarid = $catching['id']%9+1;
					?>
							<div class='article'>
				              <div class='article__area'>
				                <div class='userDetail'>
				                  <div>
				                  	<?php echo "<img src=avatar/".$avatarid.".png class='userDetail__avatar' />" ?>
				                  </div>
				                  <div>
				                    <div class='userDetail__creater'><?php echo $catching['nickname'] ?></div>
				                    <div class='userDetail__created_at'><?php echo $catching['created_at'] ?></div>
				                  </div>
				                  	<?php
								// 這邊如果是使用者本人 跳出修改及刪除留言的 dropdown-menu
										if($catching['nickname'] == $user_nickname) {
									?>
								<!-- 這個是從 bootstrap 抓下來的用法 一定要記得引用jquery 好像還有一個 pop 什麼的才能用 -->
											<div class="dropdown edit">
												<button class="btn btn-dark dropdown-toggle createcomment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												</button>
												<div class="dropdown-menu padding0" aria-labelledby="dropdownMenuButton">
												    <div class="dropdown-item editing">編輯</div>
												    <div class="dropdown-item deleting">刪除</div>
												</div>
											</div>
									<?php
										}
									?>
				                </div>
				                <h><?php echo $catching['title'] ?></h>
				                <p><?php echo nl2br(htmlspecialchars($catching["content"],ENT_QUOTES,'UTF-8')) ?></p>
				              </div>
				            </div>
				</div>
				<div class='reminder navBar'>以下是留言!!</div>
					<?php
						// 先撰寫文章的副留言 最後在顯示留言欄 放上機器以後不知道為什麼這邊以下的東西都顯示不出來  頭好痛
						$stmt1 = $conn->prepare("SELECT * FROM swordlion_knife_users LEFT JOIN swordlion_knife_subcomment ON swordlion_knife_users.id = swordlion_knife_subcomment.user_id WHERE major = ? ORDER BY created_at DESC");
						$stmt1->bind_param('s',$pagenum);
						$stmt1->execute();
						$catch1 = $stmt1->get_result();
						if($catch1->num_rows > 0) {
					?>
						<div class='subcomment-list'>
					<?php
							while($catching1 = $catch1->fetch_assoc()) {
								$avatarid1 = $catching1['id']%9+1;
					?>
						<div class='subcomment'>
		                	<div class='userDetail'>
		                    	<div>
		                  			<?php echo "<img src=avatar/".$avatarid1.".png class='userDetail__avatar' />" ?>
		                  		</div>
		                  		<div>
		                    		<div class='userDetail__creater'><?php echo $catching1['nickname'] ?></div>
		                    		<div class='userDetail__created_at'><?php echo $catching1['created_at'] ?></div>
		                  		</div>
		                  		<?php
									// 這邊如果是使用者本人 跳出修改及刪除留言的 dropdown-menu
									if($catching1['nickname'] == $user_nickname) {
									?>
								<!-- 這個是從 bootstrap 抓下來的用法 一定要記得引用jquery 好像還有一個 pop 什麼的才能用 -->
									<div class="dropdown edit">
										<button class="btn btn-dark dropdown-toggle createcomment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										</button>
										<div class="dropdown-menu padding0" aria-labelledby="dropdownMenuButton">
										    <div class="dropdown-item editing sub">編輯</div>
										    <div class="dropdown-item deleting sub">刪除</div>
										</div>
									</div>
								<?php
									}
								?>
			                </div>
			                <input type='hidden' name='num' value=<?php echo $catching1['num'] ?> />
			                <p><?php echo nl2br(htmlspecialchars($catching1["content"],ENT_QUOTES,'UTF-8')) ?></p>
		                </div>
					<?php
							}
					?>
						</div>
					<?php
						}
					?>
					<div class='leavecomment-area'>
		                <form class='subcomment__form' method='POST' action='create__subcomment.php'>
		                	<div class='userDetail'>
			                  <div>
			                  	<img src=avatar/<?php echo ($user_id % 9 + 1) ?>.png class='userDetail__avatar' />
			                  </div>
			                  <div class='userDetail__createrinfo'>
			                    <div class='userDetail__creater'><?php echo $user_nickname ?></div>
			                  </div>
			                </div>
			                <div class="dropdown">
								<button class="btn btn-dark dropdown-toggle createcomment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">😄
								</button>
								<div class="dropdown-menu comment" aria-labelledby="dropdownMenuButton">
								</div>
							</div>
							<textarea name='content' class='leavecomment__textarea' placeholder="有什麼想法想分享的嗎~"></textarea>
							<input type='hidden' name='major' value=<?php echo $pagenum ?> />
							<button type='submit' class='btn btn-primary leavecomment__submitbutton'>發送留言!</button>
		                </form>
					</div>
					<?php	
						}
					?>
			</div>
			<div class='personal'>
				<?php
				// 如果沒登入主留言欄會顯示登入
					if(!$is_login) {
				?>
						<div class="login">
							<a href="login.php" class="button">登入起來!</a>
							<img src='headicon.jpeg' class='login__notlogin' />
						</div>
				<?php
				// 如果有登入主留言欄會顯示留言區塊
					} else {
				?>
				<div class="personal__icon">
					<?php
						$stmt = $conn->prepare("SELECT * from swordlion_knife_users LEFT JOIN swordlion_knife_users_certificate ON swordlion_knife_users_certificate.username = swordlion_knife_users.username WHERE certificate = ?");
						$stmt-> bind_param("s", $_COOKIE["member_id"]);
						$stmt-> execute();
						$find = $stmt->get_result();
						$find1 = $find->fetch_assoc();
						echo "<img src='avatar/". ($find1['id'] % 9 + 1) .".png' class='personal__icon__avatar' />";	
					?>
					<div class="personal__userinfo">
						<div class="description">小劍獅:</div>
					<?php
						echo "<div class='personal__userinfo__username'>".$find1['nickname']."</div>";
					?>
					</div>
				</div>
				<?php
					}
				?>
			</div>
			<div id="showbox"></div>
		</div>
	</body>

</html>
