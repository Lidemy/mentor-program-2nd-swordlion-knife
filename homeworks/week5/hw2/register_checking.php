<?php
	require('randomcertificateid.php');
	require('connection.php');

	$usernames = '';
	$passwords = '';
	$nickname = '';


	if (isset($_POST['usernames']) && isset($_POST['passwords']) && isset($_POST['nickname']) && !empty($_POST['usernames']) && !empty($_POST['passwords']) && !empty($_POST['nickname'])) {
		
		$username = $_POST['usernames']; 
	   	$password = md5($_POST['passwords']);
	   	$nickname = $_POST['nickname'];
		
	   	$stmt = $conn->prepare("SELECT * from users WHERE username=?");
	   	$stmt->bind_param("s",$username);
	    $stmt->execute();
	    $result = $stmt->get_result();
	 
		if($result->num_rows > 0) {
			echo "<script>alert ('這帳號太夯了!換一個霸脫');location.href ='register.php';</script>";
		} else {
			
		   	$stmt2 =$conn->prepare( "INSERT INTO users (username, password,nickname) VALUES (?, ?, ?)");
		   	$stmt2->bind_param("sss",$username,$password,$nickname);
		    $stmt2->execute();
			
			if ($stmt2){
				//設置通行證
				$cookie = randtext();
				$stmt3 = $conn->prepare("INSERT INTO users_certificate ( username, certificate) VALUES (?,?)");
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