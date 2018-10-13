	<div class='littlebox'>
		<div class='openbox'>回應→</div>
		<form action='posttocomments.php' method="POST">
			<input class='content' name='content' type ='text' placeholder="留言內容" /><br>
			<input type='hidden' name="mainoradd" value=<?php echo $data["id"] ?> >
			<?php
				if ($is_login) {
					echo "<input class='submit' type ='submit' value='留言'/>";
				} else {
					echo "<input class='submit' type ='submit' value='請先登入'/>";
				}
			?>
		</form>
	</div>
