<?php

	require_once('connection.php');
	//抓取使用者ID
	$stmt = $conn->prepare("SELECT * from swordlion_knife_users LEFT JOIN swordlion_knife_users_certificate ON swordlion_knife_users_certificate.username = swordlion_knife_users.username WHERE certificate = ?");
	$stmt-> bind_param("s", $_COOKIE["member_id"]);
	$stmt-> execute();
	$find = $stmt->get_result();
	$find1 = $find->fetch_assoc();
	$user_id = $find1['id'];


	if(isset($_POST['content']) && !empty($_POST['content'])) {

		//這邊插入剛剛輸出的副留言
		$major = $_POST['major'];
		$content = $_POST['content'];

		$stmt = $conn->prepare("INSERT INTO swordlion_knife_subcomment (`major`,`user_id`,`content`) VALUES (?,?,?)");
		$stmt->bind_param('sss',$major,$user_id,$content);
		$stmt->execute();
		// 如果輸入成功 抓取資訊 他會抓取第一個?  (現在回頭看突然覺得這樣好怪)
		if($stmt) {
			$stmt1 = $conn->prepare("SELECT * FROM swordlion_knife_users LEFT JOIN swordlion_knife_subcomment ON swordlion_knife_subcomment.user_id = swordlion_knife_users.id WHERE major = ? ORDER BY created_at DESC");
			$stmt1->bind_param('s',$major);
			$stmt1->execute();
			$insure = $stmt1->get_result(); 
			if ($insure->num_rows >0) {
				$data = $insure->fetch_assoc();
				$major1 = $data['major'];
				$time = $data["created_at"];
				$num = $data["num"];
				$arr = array('result'=>'success','userid'=>$user_id,"time"=>$time,"major"=>$major1,"num"=>$num,'nickname'=>$_COOKIE['member_nickname']);
				echo json_encode($arr);
			}
		}
	}

	$conn->close();
	
?>
