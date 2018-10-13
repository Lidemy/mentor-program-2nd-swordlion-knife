<?php
	require('conn.php');


	$stmt3 = $conn->prepare("SELECT * from users_certificate LEFT JOIN users on users_certificate.username=users.username WHERE certificate =?");
	$stmt3->bind_param("s", $_COOKIE["member_id"]);
	$stmt3->execute();
	$result = $stmt3->get_result();
	if ($result->num_rows>0) {
		$takeid = $result->fetch_assoc();
		$user_id = $takeid["id"];
		$username = $takeid["username"];
	}

	$content = '';
	$mainoradd = '';

	if (isset($_POST['content']) && !empty($_POST['content']) && isset($_COOKIE["member_id"])) {
		
	    $content = addslashes($_POST['content']); 
	    $mainoradd = $_POST['mainoradd'];

	    // 主留言

	    if($mainoradd === '0') {
	    	$stmt = $conn->prepare("INSERT INTO comments (`mainoradd`,`user_id` , `content`) VALUES ('0',? ,?)");
	    	$stmt->bind_param("ss",$user_id, $content);
	    	$stmt->execute();

			if ($stmt) {
				//抓取剛剛插入的主留言資訊
				$stmt4 =$conn->prepare("SELECT * FROM users LEFT JOIN comments ON comments.user_id = users.id WHERE mainoradd = 0 ORDER BY created_at DESC");
				$stmt4->execute();
				$insure = $stmt4->get_result(); 
				if ($insure->num_rows >0) {
					$data = $insure->fetch_assoc();
					$time = $data["created_at"];
				}

				//echo "<script class='remove'>alert ('恭喜您新增了一筆留言!');</script>";
				$arr = array('result'=>'success','userid'=>$user_id,"username"=>$username,"time"=>$time);
				echo json_encode($arr);
			} else {
				echo "<script>alert ('oops!something went wrong!'); location.href ='add_comments.php';</script>";
			}

	    }


	    //副留言


	    else {
	    	$stmt2 = $conn->prepare("INSERT INTO comments (`mainoradd`,`user_id` , `content`) VALUES (?,?,?)");
	    	$stmt2->bind_param("sss",$mainoradd,$user_id, $content);
	    	$stmt2->execute();
			
			if ($stmt2) {
					//抓取剛剛插入的副留言資訊
				$stmt5 =$conn->prepare("SELECT * FROM users LEFT JOIN comments ON comments.user_id = users.id WHERE mainoradd = ? ORDER BY created_at DESC");
				$stmt5->bind_param("s",$_POST['mainoradd']);
				$stmt5->execute();
				$insure2 = $stmt5->get_result(); 
				if ($insure2->num_rows >0) {
					$data2 = $insure2->fetch_assoc();
					$time2 = $data2["created_at"];
				}
				//echo "<script class='remove'>alert ('恭喜您新增了一筆留言!');</script>";
				$arr = array('result'=>'success2',"userid"=>$data2["id"],'username'=>$username,'time'=>$time2);
				echo json_encode($arr);
			} else {
				echo "<script>alert ('oops!something went wrong!'); location.href ='add_comments.php';</script>";
			}
	    }
	} else if (!isset($_COOKIE["member_id"])) {
		echo "<script>alert ('請先登入!!!'); location.href ='login.php';</script>";
	} else {
		echo "<script>alert ('欄位不可為空!!!'); location.href ='add_comments.php';</script>";
	}
	
?>
