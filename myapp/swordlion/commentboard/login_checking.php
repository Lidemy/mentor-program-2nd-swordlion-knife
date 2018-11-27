<?php
	// 確認有沒有登入成功的
	require_once('connection.php');
	
	$usernames = '';
	$passwords = '';
	$nickname = '';
	$check = 1 ;
	// 這邊那時候也弄了好久 判斷帳號有沒有中文
	for($i = 0; $i < strlen($_POST['usernames']); $i++ ) {
		if(!ctype_alpha($_POST['usernames'][$i]) && !is_numeric($_POST['usernames'][$i])) {
			$check = 0 ;
			echo "<script>alert ('帳號只能有英文跟數字喔~~再試一次吧!');location.href ='register.php';</script>";
		}
	}	

	if (isset($_POST['usernames']) && isset($_POST['passwords']) && !empty($_POST['usernames']) && !empty($_POST['passwords']) && $check == 1) {

		$username = $_POST['usernames']; 
		// 用 md5 去加密 雖然聽說很容易破解 之前 CS50 好像寫過 salt +密的 以後有時間再改一下!
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
			// 登入成功的話設定 cookie
			setcookie("member_id", $fetch2['certificate'], time()+3600*24);
			setcookie("member_nickname",$row['nickname'],time()+3600*24);
			echo "<script>alert ('小劍獅". $row['nickname'] ."!歡迎回家:D'); location.href ='index.php';</script>";
		} else {
			echo "<script>alert ('是不是沒有帳號捏~~'); location.href ='register.php';</script>";
		}
	}
	// 因為我一定不會知道是哪裡出了問題QQ
	echo "<script>alert ('這一定是哪裡出了問題!晚點再試一次吧!~~'); location.href ='login.php';</script>";

	$conn->close();

?>

