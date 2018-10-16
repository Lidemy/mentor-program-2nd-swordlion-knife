<?php
	require('randomcertificateid.php');
	require('connection.php');

	$usernames = '';
	$passwords = '';
	$nickname = '';
	$check = 1 ;
	for($i = 0; $i < strlen($_POST['usernames']); $i++ ) {
		if($_POST['usernames'][$i] >= 'Z' || $_POST['usernames'][$i] <= 'A') {
			if($_POST['usernames'][$i] >= 'z' || $_POST['usernames'][$i] <='a') {
				if(!is_numeric($_POST['usernames'][$i])) {
					$check = 0 ;
					echo "<script>alert ('帳號只能有英文跟數字喔~~再試一次吧!');location.href ='login.php';</script>";
				}
			}
		}
	}	

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
	 
		if($result->num_rows > 0) {
			echo "<script>alert ('這帳號太夯了!換一個霸脫');location.href ='register.php';</script>";
		} else {
			
		   	$stmt2 =$conn->prepare( "INSERT INTO swordlion_knife_users (username, password,nickname) VALUES (?, ?, ?)");
		   	$stmt2->bind_param("sss",$username,$password,$nickname);
		    $stmt2->execute();
			
			if ($stmt2){
				//設置通行證
				$cookie = randtext();
				$stmt3 = $conn->prepare("INSERT INTO swordlion_knife_users_certificate ( username, certificate) VALUES (?,?)");
				$stmt3->bind_param("ss", $username,$cookie );
				$stmt3->execute();

				setcookie("member_id", $cookie, time()+3600*24);

				echo "<script>alert ('註冊成功!來看看有誰留言了吧!');location.href ='index.php';</script>";
				} else {
					echo "<script>alert ('註冊失敗~!一定是哪裡搞錯了QQ');location.href ='register.php';</script>";
				}
			}

	}
	echo "<script>alert ('是不是有帳號了捏~~');location.href ='login.php';</script>";
	$conn->close();
?>