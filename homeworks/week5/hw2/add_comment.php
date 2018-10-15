<?php
	require('connection.php');


	$stmt = $conn->prepare("SELECT * from users_certificate LEFT JOIN users on users_certificate.username=users.username WHERE certificate = ? ");
	$stmt->bind_param("s", $_COOKIE["member_id"]);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$takeid = $result->fetch_assoc();
		$user_id = $takeid["id"];
		$username = $takeid["username"];
	}

	$content = '';
	$major = '';
	
	if (isset($_POST['content']) && !empty($_POST['content']) && isset($_COOKIE["member_id"])) {
		
	    $content = addslashes($_POST['content']); 
	    $major = $_POST['major'];

	    // 主留言

	    if($major === '0') {
	    	$stmt = $conn->prepare("INSERT INTO comments (`major`,`user_id` , `content`) VALUES ('0',? ,?)");
	    	$stmt->bind_param("ss",$user_id, $content);
	    	$stmt->execute();

			if ($stmt) {
				//抓取剛剛插入的主留言資訊
				$stmt = $conn->prepare("SELECT * FROM users LEFT JOIN comments ON comments.user_id = users.id WHERE major = 0 ORDER BY created_at DESC");
				$stmt->execute();
				$insure = $stmt->get_result(); 
				if ($insure->num_rows >0) {
					$data = $insure->fetch_assoc();
					$time = $data["created_at"];
				}

				echo "<script>alert ('小劍獅留言成功!'); location.href ='index.php';</script>";
				// $arr = array('result'=>'success','userid'=>$user_id,"username"=>$username,"time"=>$time);
				// echo json_encode($arr);
			} else {
				echo "<script>alert ('一定是哪裡搞錯了QQ'); location.href ='index.php';</script>";
			}

	    }


	    //副留言


	    else {
	    	$stmt = $conn->prepare("INSERT INTO comments (`major`,`user_id` , `content`) VALUES (?,?,?)");
	    	$stmt->bind_param("sss",$major,$user_id, $content);
	    	$stmt->execute();
			
			if ($stmt) {
					//抓取剛剛插入的副留言資訊
				$stmt =$conn->prepare("SELECT * FROM users LEFT JOIN comments ON comments.user_id = users.id WHERE major = ? ORDER BY created_at DESC");
				$stmt->bind_param("s",$_POST['major']);
				$stmt->execute();
				$insure = $stmt->get_result(); 
				if ($insure->num_rows >0) {
					$data = $insure->fetch_assoc();
					$time = $data["created_at"];
				}
				echo "<script>alert ('小劍獅回覆成功!'); location.href ='index.php';</script>";
				// $arr = array('result'=>'success2',"userid"=>$data2["id"],'username'=>$username,'time'=>$time2);
				// echo json_encode($arr);
			} else {
				echo "<script>alert ('一定是哪裡搞錯了QQ'); location.href ='index.php';</script>";
			}
	    }
	} else if (!isset($_COOKIE["member_id"])) {
		echo "<script>alert ('小劍獅太多啦!先登入吧~~'); location.href ='login.php';</script>";
	} else {
		echo "<script>alert ('你是不是有什麼沒打R~'); location.href ='index.php';</script>";
	}
	
?>
