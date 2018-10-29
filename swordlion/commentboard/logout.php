<?php
	$is_login = false;
	setcookie("member_id","",time()-3600);
	setcookie("member_nickname","",time()-3600);
	echo "<script>window.history.back();</script>";
?>
