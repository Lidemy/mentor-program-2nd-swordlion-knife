<?php

	require_once('connection.php');

	$stmt = $conn->prepare("SELECT * FROM swordlion_knife_article WHERE num = ? ");
	$stmt->bind_param('s',$_POST['num']);
	$stmt->execute();
	$result = $stmt->get_result();
	$fetch = $result->fetch_assoc();

	if($fetch['title'] == $_POST['title'] && $fetch['content'] == $_POST['content']) {
		echo "<script>alert ('還是要改一下啦~~'); location.replace(document.referrer);</script>";
	} else {
		$stmt = $conn->prepare("UPDATE swordlion_knife_article SET title = ? , content = ? WHERE num = ? ");
		$stmt->bind_param("sss",$_POST['title'],$_POST['content'],$_POST['num']);
		$stmt->execute();
		
		/*if($stmt) {
			echo "<script>alert ('恭喜你!修改成功~~'); location.replace(document.referrer);</script>";
		} else {
			echo "<script>alert ('失敗了耶!一定是哪裡搞錯了~~'); location.replace(document.referrer);</script>";
		}*/
	}

	$conn->close();
	
?>