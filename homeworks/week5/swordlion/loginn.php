<?php
	

	require('randomcertificateid.php');
	require('conn.php');
	
	$usernames='';
	$passwords='';
	

	if (isset($_POST['usernames']) && isset($_POST['passwords'])) {
		
		$username = $_POST['usernames']; 
	    $password = md5($_POST['passwords']); 


	    $stmt = $conn->prepare("SELECT * from users WHERE username=? and password=?");
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows>0) {
			$row = $result->fetch_assoc();
			//設置通行證
			$stmt2 = $conn->prepare("SELECT * from users_certificate WHERE username = ?");
			$stmt2->bind_param("s", $row['username']);
			$stmt2->execute();
			$fetch = $stmt2->get_result();
			$fetch2 = $fetch->fetch_assoc();
			setcookie("member_id", $fetch2['certificate'], time()+3600*24);
			echo "<script>alert ('登入成功'); location.href ='add_comments.php';</script>";
		} else {
			echo "<script>alert ('登入失敗!請再試一次~'); location.href ='login.php';</script>";
		}
	}
	echo "<script>alert ('欄位不能為空!'); location.href ='login.php';</script>";
	$conn->close();
?>

