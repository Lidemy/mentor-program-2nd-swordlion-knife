<?php
	
	require('connection.php');
	
	$usernames = '';
	$passwords = '';
	$nickname = '';

	if (isset($_POST['usernames']) && isset($_POST['passwords']) && !empty($_POST['usernames']) && !empty($_POST['passwords'])) {
		
		$username = $_POST['usernames']; 
	    $password = md5($_POST['passwords']); 


	    $stmt = $conn->prepare("SELECT * from users WHERE username=? and password=?");
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			//設置通行證
			$stmt2 = $conn->prepare("SELECT * from users_certificate WHERE username = ?");
			$stmt2->bind_param("s", $username);
			$stmt2->execute();
			$fetch = $stmt2->get_result();
			$fetch2 = $fetch->fetch_assoc();
			setcookie("member_id", $fetch2['certificate'], time()+3600*24);
			echo "<script>alert ('小劍獅". $row['nickname'] ."!歡迎回家:D'); location.href ='index.php';</script>";
		} else {
			echo "<script>alert ('是不是哪裡打錯啦~~再確認一次吧~~'); location.href ='login.php';</script>";
		}
	}
	echo "<script>alert ('是不是沒有帳號捏~~'); location.href ='register.php';</script>";
	$conn->close();
?>

