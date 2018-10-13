<?php
	require('randomcertificateid.php');
	require('conn.php');

	$usernames='';
	$passwords='';


	if (isset($_POST['usernames']) && isset($_POST['passwords']) && !empty($_POST['usernames']) && !empty($_POST['passwords'])) {
		
		$username = $_POST['usernames']; 
	   	$password = md5($_POST['passwords']);
		
	   	$stmt = $conn->prepare("SELECT * from users WHERE username=?");
	   	$stmt->bind_param("s",$username);
	    $stmt->execute();
	    $result = $stmt->get_result();
	  

		if($result->num_rows > 0) {
			echo "<script>alert ('這個帳號有人用了!');location.href ='register.php';</script>";
		} else {
			
		   	$stmt2 =$conn->prepare( "INSERT INTO users (username, password) VALUES (?, ?)");
		   	$stmt2->bind_param("ss",$username,$password);
		    $stmt2->execute();
			
			if ($stmt2){
				//設置通行證
				$cookie = randtext();
				$stmt3 = $conn->prepare("INSERT INTO users_certificate (certificate , username) VALUES (?,?)");
				$stmt3->bind_param("ss", $cookie, $username);
				$stmt3->execute();

				setcookie("member_id", $cookie, time()+3600*24);

				echo "<script>alert ('註冊成功!');location.href ='add_comments.php';</script>";
				} else {
					echo "<script>alert ('註冊失敗，請重新註冊!');location.href ='register.php';</script>";
				}
			}

	}
	echo "<script>alert ('註冊失敗，請重新註冊!');location.href ='register.php';</script>";

	$conn->close();
?>