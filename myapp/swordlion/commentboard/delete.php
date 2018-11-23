<?php
	// 這是刪除資料的 PHP 拿去做 AJAX 了~
	require_once('connection.php');
	
	// 安全性問題
	$stmt = $conn->prepare("SELECT * FROM swordlion_knife_comments WHERE num = ?");
	$stmt->bind_param("s",$_POST['num']);
	$stmt->execute();
	$find = $stmt->get_result();
	$find1 = $find->fetch_assoc();
	// 這邊要再確認一次使用者身分
	if(!empty($_COOKIE['member_id'])) {
		if(!$find1['major'] == 0 ) {
			$stmt1 = $conn->prepare("DELETE FROM swordlion_knife_comments WHERE num = ? ");
			$stmt1->bind_param("s",$_POST['num']);
			$stmt1->execute();
			/*if($stmt1){
				echo "<script>alert('成功刪除啦~~!!');location.replace(document.referrer);</script>";
			} else {
				echo "<script>alert('好像哪裡出了問題QQ~~');location.replace(document.referrer);</script>";
			}*/
		} else {
			$stmt2 = $conn->prepare("DELETE FROM swordlion_knife_comments WHERE num = ? OR major = ? ");
			$stmt2->bind_param("ss",$_POST['num'] , $_POST['num']);
			$stmt2->execute();
			/*if($stmt2) {
				echo "<script>alert('成功刪除啦~~!!');location.replace(document.referrer);</script>";
			} else {
				echo "<script>alert('好像哪裡出了問題QQ~~');location.replace(document.referrer);</script>";
			}*/
		}
	} 

	// echo "<script>alert('好像哪裡出了問題QQ~~');location.replace(document.referrer);</script>";
	
	$conn->close();

?>