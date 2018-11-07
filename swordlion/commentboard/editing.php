<?php
	
	// 編輯的 PHP ，通通拿去做 AJAX 了

	require_once('connection.php');

	if($_POST['content'] == $_POST['helper']) {
		echo "<script>alert ('這樣沒有改不行捏~~'); location.href ='index.php';</script>";
	}
	
	if (isset($_POST['content']) && !empty($_POST['content'])) {

		$content = addslashes($_POST['content']);

	    $stmt = $conn->prepare("UPDATE swordlion_knife_comments SET content = ? WHERE num = ? ");
		$stmt->bind_param("ss", $content, $_POST['num']);
		$stmt->execute();
		
		if($stmt) {
			echo "<script>alert ('恭喜你!修改成功~~'); location.replace(document.referrer);</script>";
		} else {
			echo "<script>alert ('失敗了耶!一定是哪裡搞錯了~~'); location.replace(document.referrer);</script>";
		}
	}

	$conn->close();
	
?>