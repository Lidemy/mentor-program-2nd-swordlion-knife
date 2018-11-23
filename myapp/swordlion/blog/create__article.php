<?php

	require_once('connection.php');
	//抓取使用者ID
	$stmt = $conn->prepare("SELECT * from swordlion_knife_users LEFT JOIN swordlion_knife_users_certificate ON swordlion_knife_users_certificate.username = swordlion_knife_users.username WHERE certificate = ?");
	$stmt-> bind_param("s", $_COOKIE["member_id"]);
	$stmt-> execute();
	$find = $stmt->get_result();
	$find1 = $find->fetch_assoc();
	$user_id = $find1['id'];


	if(isset($_POST['title']) && isset($_POST['content']) && !empty($_POST['title']) && !empty($_POST['content'])) {

		//這邊插入剛剛輸出的文章
		$title = $_POST['title'];
		$content = $_POST['content'];

		$stmt = $conn->prepare("INSERT INTO swordlion_knife_article (`title`,`major`,`user_id`,`content`) VALUES (?,'0',?,?)");
		$stmt->bind_param('sss',$title,$user_id,$content);
		$stmt->execute();
		// 如果輸入成功 抓取資訊 他會抓取第一個?  (現在回頭看突然覺得這樣好怪)
		if($stmt) {
			$stmt1 = $conn->prepare("SELECT * FROM swordlion_knife_users LEFT JOIN swordlion_knife_article ON swordlion_knife_article.user_id = swordlion_knife_users.id WHERE major = 0 ORDER BY created_at DESC");
			$stmt1->execute();
			$insure = $stmt1->get_result(); 
			if ($insure->num_rows >0) {
				$data = $insure->fetch_assoc();
				$time = $data["created_at"];
				$num = $data["num"];
				$arr = array('result'=>'success','userid'=>$user_id,"time"=>$time,"num"=>$num,'nickname'=>$_COOKIE['member_nickname']);
				echo json_encode($arr);
			}
		}
	}

	$conn->close();
	
?>
