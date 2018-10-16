<?php
	
	require('connection.php');
	
	$usernames = '';
	$passwords = '';
	$nickname = '';
	$check = 1 ;
	for($i = 0; $i < strlen($_POST['usernames']); $i++ ) {
		if($_POST['usernames'][$i] >= 'Z' || $_POST['usernames'][$i] <= 'A') {
			if($_POST['usernames'][$i] >= 'z' || $_POST['usernames'][$i] <='a') {
				if(!is_numeric($_POST['usernames'][$i])) {
					$check = 0;
					echo "<script>alert ('帳號只能打英文跟數字喔~~再試一次吧!');location.href ='login.php';</script>";
				}
			}
		}
	}	

	if (isset($_POST['usernames']) && isset($_POST['passwords']) && !empty($_POST['usernames']) && !empty($_POST['passwords']) && $check == 1) {

		$username = $_POST['usernames']; 
	    $password = md5($_POST['passwords']); 


	    $stmt = $conn->prepare("SELECT * from swordlion_knife_users WHERE username=? and password=?");
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			//設置通行證
			$stmt2 = $conn->prepare("SELECT * from swordlion_knife_users_certificate WHERE username = ?");
			$stmt2->bind_param("s", $username);
			$stmt2->execute();
			$fetch = $stmt2->get_result();
			$fetch2 = $fetch->fetch_assoc();
			setcookie("member_id", $fetch2['certificate'], time()+3600*24);
			echo "<script>alert ('小劍獅". $row['nickname'] ."!歡迎回家:D'); location.href ='index.php';</script>";
		} else {
			echo "<script>alert ('是不是沒有帳號捏~~'); location.href ='register.php';</script>";
		}
	}
	echo "<script>alert ('是不是沒有帳號捏~~'); location.href ='register.php';</script>";
?>

