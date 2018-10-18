<div class='container'>
	<?php
		$stmt = $conn->prepare("SELECT * FROM swordlion_knife_users LEFT JOIN swordlion_knife_comments ON swordlion_knife_comments.user_id = swordlion_knife_users.id WHERE major = 0 ORDER BY created_at DESC");
		$stmt->execute();
		$insure = $stmt->get_result(); 
		if ($insure->num_rows > 0) {
		//只要能抓到主留言，就會一直持續下去
			while ( $data = $insure->fetch_assoc()) {
	?>
	<div class='comment-display'>
		<div class="main-list">
			<div class="comment__form__icon">
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
				// 如果是使用者本人 跳出修改及刪除留言的小按鈕
					if($data['nickname'] == $user_nickname) {
				?>
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
		<div class='sub-list'>
		<?php
			// 主留言下面的留言欄
			if(!$is_login) {
			//沒登入顯示
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
				<?php
					echo "<input type='hidden' value='". $data['num'] ."' name='major'>";
				?>
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

			if ($subcommentcreater->num_rows > 0) {
				while ($data1 = $subcommentcreater->fetch_assoc()) {
			//副留言迴圈		
		?>
		<div class='sub_comment adding'>
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
				// 如果是使用者本人 跳出修改及刪除留言的小按鈕
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
			<input type="hidden" name="num" value=<?php echo $data1['num'] ?> />
			<div class='comment_content'><?php echo htmlspecialchars($data1["content"], ENT_QUOTES,'UTF-8');?></div>
		</div>
	<?php
			}
		}
	?>
	</div>
	</div>
	<?php
		}
	}
	?>
</div>

