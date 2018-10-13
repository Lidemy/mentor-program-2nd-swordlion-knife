<?php
	$is_login = false;
	setcookie("member_id","",time()-3600);
	header("location:add_comments.php");
?>
