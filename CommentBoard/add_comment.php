<?php

	require_once('connection.php');

	$stmt = $conn->prepare("SELECT * from swordlion_knife_users_certificate LEFT JOIN swordlion_knife_users on swordlion_knife_users_certificate.username = swordlion_knife_users.username WHERE certificate = ? ");
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
	    	$stmt = $conn->prepare("INSERT INTO swordlion_knife_comments (`major`,`user_id` , `content`) VALUES ('0',? ,?)");
	    	$stmt->bind_param("ss",$user_id, $content);
	    	$stmt->execute();

			if ($stmt) {
				//抓取剛剛插入的主留言資訊
				$stmt = $conn->prepare("SELECT * FROM swordlion_knife_users LEFT JOIN swordlion_knife_comments ON swordlion_knife_comments.user_id = swordlion_knife_users.id WHERE major = 0 ORDER BY created_at DESC");
				$stmt->execute();
				$insure = $stmt->get_result(); 
				if ($insure->num_rows >0) {
					$data = $insure->fetch_assoc();
					$time = $data["created_at"];
					$num = $data["num"];
				}

				// echo "<script>alert ('小劍獅留言成功!');location.replace(document.referrer);</script>";
				// json_encode -> ajax
				$arr = array('result'=>'success','userid'=>$user_id,"username"=>$username,"time"=>$time,"num"=>$num);
				 echo json_encode($arr);
			} else {
				echo "<script>alert ('一定是哪裡搞錯了QQ'); location.replace(document.referrer);</script>";
			}

	    }


	    //副留言


	    else {
	    	$stmt = $conn->prepare("INSERT INTO swordlion_knife_comments (`major`,`user_id` , `content`) VALUES (?,?,?)");
	    	$stmt->bind_param("sss",$major,$user_id, $content);
	    	$stmt->execute();
			
			if ($stmt) {
					//抓取剛剛插入的副留言資訊
				$stmt =$conn->prepare("SELECT * FROM swordlion_knife_users LEFT JOIN swordlion_knife_comments ON swordlion_knife_comments.user_id = swordlion_knife_users.id WHERE major = ? ORDER BY created_at DESC");
				$stmt->bind_param("s",$_POST['major']);
				$stmt->execute();
				$insure = $stmt->get_result(); 
				if ($insure->num_rows >0) {
					$data = $insure->fetch_assoc();
					$time = $data["created_at"];
					$major2 = $data["major"];
					$num = $data["num"];
				}
				// echo "<script>alert ('小劍獅回覆成功!'); location.replace(document.referrer);</script>";
				$arr = array('result'=>'success2',"userid"=>$data["id"],'username'=>$username,'time'=>$time,'major'=>$major2,"num"=>$num);
				echo json_encode($arr);
			} else {
				echo "<script>alert ('一定是哪裡搞錯了QQ');location.replace(document.referrer);</script>";
			}
	    }
	} else if (!isset($_COOKIE["member_id"])) {
		echo "<script>alert ('小劍獅太多啦!先登入吧~~'); location.href ='login.php';</script>";
	} else {
		echo "<script>alert ('你是不是有什麼沒打R~'); location.replace(document.referrer);</script>";
	}

	$conn->close();
	
?>
