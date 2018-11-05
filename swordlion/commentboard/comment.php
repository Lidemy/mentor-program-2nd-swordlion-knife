<div class='container main'>
	<?php
		// 這邊判斷現在的網址在哪裡
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		// 這邊原本想弄 split 但那時候好像用不了 最後找到 explode 這個 function 一樣可以用 '' 裡的東西當分界點 分成兩塊 這是為了做分頁 
		$pagenumcal = explode('page=',$actual_link);
		// 如果後面沒指定在第幾頁的話 就算是第一頁 
		if(!$_SERVER['QUERY_STRING']) {
			$pagenum = 0;
		} else {
			$pagenum = ($pagenumcal[1]-1)*4;
		}
		// 這邊原本想用 bind_param 的，但不明原因的失敗了, 不知道這樣用有沒有風險QQ
		// 用 LIMIT 抓取從第幾筆開始的資料，一次抓4個
		$stmt = $conn->prepare("SELECT * FROM swordlion_knife_users LEFT JOIN swordlion_knife_comments ON swordlion_knife_comments.user_id = swordlion_knife_users.id WHERE major = 0 ORDER BY created_at DESC LIMIT ".$pagenum.",4");
		$stmt->execute();
		$insure = $stmt->get_result(); 
		// 如果抓取到的資料有至少 1 個 接下去
		if ($insure->num_rows > 0) {
			// 只要有抓到就重複主留言的輸出
			while ( $data = $insure->fetch_assoc()) {
	?>
	<!-- 每個留言欄由主留言跟副留言構成，這是包住兩個的 block  -->
	<div class='comment-display'>
		<!-- 先來做主留言 -->
		<div class="main-list">
			<!-- 主留言是由使用者資訊、留言內容跟這邊我放了一個 hidden 的 input[name='num'] 這是為了做副留言 AJAX 的時候能知道是在哪個 num 的主留言下面 -->
			<div class="comment__form__icon">
				<!-- 使用者資訊 包含三個 avatar nickname 跟創造時間 -->
				<?php
					echo "<img src='avatar/". $data['id'] % 9 .".png' class='comment__form__icon__avatar' />";
				?>
				<div class="comment__form__icon__userinformation">
				<?php
					echo "<div class='comment__form__icon__userinformation__username'>".$data['nickname']."</div>";
				?>
					<div class='comment__form__icon__userinformation__created-time'><?php echo $data["created_at"];?></div>
				</div>
				<?php
				// 這邊如果是使用者本人 跳出修改及刪除留言的 dropdown-menu
					if($data['nickname'] == $user_nickname) {
				?>
				<!-- 這個是從 bootstrap 抓下來的用法 一定要記得引用jquery 好像還有一個 pop 什麼的才能用 -->
					<div class="dropdown edit">
						<button class="btn btn-dark dropdown-toggle createcomment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						    <div class="dropdown-item editing">編輯</div>
						    <div class="dropdown-item deleting">刪除</div>
						</div>
					</div>
				<?php
					}
				?>
			</div>
			<input type="hidden" name="num" value=<?php echo $data['num'] ?> />
			<div class='comment_content'><?php echo htmlspecialchars($data["content"], ENT_QUOTES,'UTF-8');?></div>
		</div>
		<!-- 在主留言的 while 迴圈裡我們還得抓取副留言 -->
		<div class='sub-list'>
		<?php
			// 主留言下面會有副留言的留言欄
			if(!$is_login) {
			//沒登入一樣顯示請登入
		?>
			<div class="comment-display__login adding">
				<a href="login.php" class="button">登入以進行留言</a>
			</div>
		<?php
			} else {
			//登入的話顯示
		?>
			<form class="comment__form adding" action="add_comment.php" method="POST">
				<div class="comment__form__icon marginbottomzero">
					<?php
					// 這邊一樣是抓取使用者資訊
						$stmt2 = $conn->prepare("SELECT * from swordlion_knife_users LEFT JOIN swordlion_knife_users_certificate ON swordlion_knife_users_certificate.username = swordlion_knife_users.username WHERE certificate = ?");
						$stmt2-> bind_param("s", $_COOKIE["member_id"]);
						$stmt2-> execute();
						$find = $stmt2->get_result();
						$find1 = $find->fetch_assoc();
						echo "<img src='avatar/". $find1['id'] % 9 .".png' class='comment__form__icon__avatar avatar__littlesize' />";	
					?>
					<div class="comment__form__icon__userinformation">
					<?php
						echo "<div class='comment__form__icon__userinformation__username username__littlesize'>".$find1['nickname']."</div>";
					?>
					</div>
				</div>
				<!-- 這個是存進副留言的 major 我判斷在哪篇文章底下用的是主留言的 num 也是 AI 的元素 -->
				<?php
					echo "<input type='hidden' value='". $data['num'] ."' name='major'>";
				?>
				<!-- 這邊是副留言的留言區塊 -->
				<div class='wrapping'>
					<textarea class="comment__form__textarea" name="content" placeholder="有什麼想法嗎來跟大家說吧!"></textarea>
					<button type="submit" class="btn btn-dark createcomment">留言</button>
				</div>
			</form>
		<?php
			}
			//每個主留言欄的迴圈裡面還得再抓副留言
			$stmt1 = $conn->prepare("SELECT * FROM swordlion_knife_comments LEFT JOIN swordlion_knife_users ON swordlion_knife_comments.user_id = swordlion_knife_users.id WHERE major = ? ORDER BY created_at DESC");
			$stmt1->bind_param("s" , $data["num"]);
			$stmt1->execute();
			$subcommentcreater = $stmt1->get_result();
			// 如果有至少一個再進迴圈
			if ($subcommentcreater->num_rows > 0) {
				while ($data1 = $subcommentcreater->fetch_assoc()) {
			//副留言迴圈		
		?>
		<!-- 副留言的輸出 -->
		<div class='sub_comment adding'>
			<!-- 使用者資訊 -->
			<div class="comment__form__icon">
				<?php
					echo "<img src='avatar/". $data1['id'] % 9 .".png' class='comment__form__icon__avatar avatar__littlesize' />";
				?>
				<div class="comment__form__icon__userinformation addedcomment">
				<?php
					echo "<div class='comment__form__icon__userinformation__username username__littlesize'>".$data1['nickname']."</div>";
				?>
					<div class='comment__form__icon__userinformation__created-time'><?php echo $data1["created_at"];?></div>
				</div>
				<?php
				// 如果是使用者本人 跳出修改及刪除留言的 dropdownmenu
					if($data1['nickname'] == $user_nickname) {
				?>
					<div class="dropdown edit2">
						<button class="btn btn-dark dropdown-toggle createcomment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						    <div class="dropdown-item editing">編輯</div>
						    <div class="dropdown-item deleting">刪除</div>
						</div>
					</div>
				<?php
					}
				?>
			</div>
			<!-- 忘了這是幹嘛的QQ 應該也是 AJAX 用的 -->
			<input type="hidden" name="num" value=<?php echo $data1['num'] ?> />
			<div class='comment_content'><?php echo htmlspecialchars($data1["content"], ENT_QUOTES,'UTF-8');?></div>
		</div>
	<?php
			// 這是 副留言 while 的結尾
			}
		// 這是副留言如果有至少一個以上資訊時的結尾
		}
	?>
	<!-- 這是 sub-list 的結尾 -->
	</div>
	<!-- 這是包含了 main-list 跟 sub-list 的結尾 (comment-display的結尾) -->
	</div>
	<?php
		// 這是主留言 while 迴圈的結尾
		}
	// 這是主留言 if 的結尾 	
	}
	?>
</div>
<!-- 這邊是做頁數的 -->
<ul class="pageContainer">
	<!-- 上一頁 -->
	<li class="previous"><img class='previous__img' src='picture/previous.jpg'/></li>
	<?php
		// 這邊是 COUNT 去數有幾筆資料，一頁顯示剛好四筆資料，所以除與 4 的無條件進位就是有幾頁 
		$stmt3 = $conn->prepare("SELECT COUNT(*) AS count FROM swordlion_knife_comments WHERE major = 0");
		$stmt3->execute();
		$exe = $stmt3->get_result();
		$exe1 = $exe->fetch_assoc();
		$count = $exe1["count"];
		$pagecount = ceil($count/4);
		for($i = 1; $i <= $pagecount; $i++) {
			echo '<li class="page">'.$i.'</li>';
		}
	?>
	<!-- 下一頁 -->
	<li class='next'><img class='next__img' src='picture/next.jpg'/></li>
</ul>

