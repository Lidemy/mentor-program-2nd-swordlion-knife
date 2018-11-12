<?php
	// 這個是為了設置一個32碼的亂數通行證
	require('randomcertificateid.php');
	require_once('connection.php');

	$usernames = '';
	$passwords = '';
	$nickname = '';
	$check = 1 ;
	for($i = 0; $i < strlen($_POST['usernames']); $i++ ) {
		// 後來找到一個很好用的 function 能判斷他是不是英文字母
		if(!ctype_alpha($_POST['usernames'][$i]) && !is_numeric($_POST['usernames'][$i])) {
			$check = 0 ;
			echo "<script>alert ('帳號只能有英文跟數字喔~~再試一次吧!');location.href ='register.php';</script>";
		}
	}	
	// 如果暱稱超過11個字好像我的 block 會塞出來的樣子QQ
	if(strlen($_POST['nickname']) > 11) {
		echo "<script>alert ('暱稱太長了啦!來個11個字以下的');location.href ='register.php';</script>";
	}
	
	if (isset($_POST['usernames']) && isset($_POST['passwords']) && isset($_POST['nickname']) && !empty($_POST['usernames']) && !empty($_POST['passwords']) && !empty($_POST['nickname'] && $check == 1 && strlen($_POST['nickname']) <= 11)) {

		$username = $_POST['usernames']; 
	   	$password = md5($_POST['passwords']);
	   	$nickname = $_POST['nickname'];
		
	   	$stmt = $conn->prepare("SELECT * from swordlion_knife_users WHERE username=?");
	   	$stmt->bind_param("s",$username);
	    $stmt->execute();
	    $result = $stmt->get_result();
	 	// 這邊先看有沒有選過這個帳號了
		if($result->num_rows > 0) {
			echo "<script>alert ('這帳號太夯了!換一個霸脫');location.href ='register.php';</script>";
		} else {
			// 沒有的話就新增
		   	$stmt2 =$conn->prepare( "INSERT INTO swordlion_knife_users (username, password,nickname) VALUES (?, ?, ?)");
		   	$stmt2->bind_param("sss",$username,$password,$nickname);
		    $stmt2->execute();
			
			if ($stmt2){
				//設置通行證 randtext() 是從 randomcertificateid.php 來的
				$cookie = randtext();
				$stmt3 = $conn->prepare("INSERT INTO swordlion_knife_users_certificate ( username, certificate) VALUES (?,?)");
				$stmt3->bind_param("ss", $username,$cookie );
				$stmt3->execute();

				setcookie("member_id", $cookie, time()+3600*24);
				setcookie("member_nickname",$nickname,time()+3600*24);

				echo "<script>alert ('註冊成功!來看看有誰留言了吧!');location.href ='index.php';</script>";
				} else {
					echo "<script>alert ('註冊失敗~!一定是哪裡搞錯了QQ');location.href ='register.php';</script>";
				}
			}

	}
	
	echo "<script>alert ('這一定是哪裡出了問題!晚點再試一次吧!~~');location.href ='register.php';</script>";

	$conn->close();

?>