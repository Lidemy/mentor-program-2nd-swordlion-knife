<?php
	// 這是刪除資料的 PHP 拿去做 AJAX 了~
	require_once('connection.php');
	
	// 安全性問題
	// 這邊要再確認一次使用者身分
	if(!empty($_COOKIE["member_id"])) {

		$stmt = $conn->prepare("DELETE FROM swordlion_knife_article WHERE num = ? ");
		$stmt->bind_param("s",$_POST['mainnum']);
		$stmt->execute();
		if($stmt) {
			$stmt = $conn->prepare("DELETE FROM swordlion_knife_subcomment WHERE major = ?");
			$stmt->bind_param("s",$_POST['mainnum']);
			$stmt->execute();
		}
	} 

	// echo "<script>alert('好像哪裡出了問題QQ~~');location.replace(document.referrer);</script>";
	
	$conn->close();

?>