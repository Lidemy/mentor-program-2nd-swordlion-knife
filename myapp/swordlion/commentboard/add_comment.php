<?php
	// $conn->close() 問題  到底要加在哪 每個都要加嗎?
	require_once('connection.php');
	// 取得使用者資訊 後面 Json_encode 的時候用
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
		// 這邊好像不用加 addslashes 因為我後來 GOOGLE 他說只要 POST 或 GET 的資料他都會自動幫你 addslashes 
	    $content = addslashes($_POST['content']); 
	    $major = $_POST['major'];

	    // 主留言

	    if($major === '0') {
	    	// 忘記為什麼要存 user_id 了 好像是為了 JOIN 其他資料表的樣子
	    	$stmt = $conn->prepare("INSERT INTO swordlion_knife_comments (`major`,`user_id` , `content`) VALUES ('0',? ,?)");
	    	$stmt->bind_param("ss",$user_id, $content);
	    	$stmt->execute();

			if ($stmt) {
				//抓取剛剛插入的主留言資訊 (這邊一直在想有沒有比較好的方法 明明才剛插入就要抓取QQ但好像沒辦法因為畢竟時間跟 num 本來就是 INSERT 之後才有的資料，我後來在寫部落格的時候才發現這邊寫得好像怪怪的，因為我去年寫的時候好像是抓取最新插入的留言，但如果有人同時輸入留言或是剛好卡到陰就頭痛了)
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
					// 副留言多抓一個 major 傳去 ajax 用
					$major2 = $data["major"];
					$num = $data["num"];
				}
				// echo "<script>alert ('小劍獅回覆成功!'); location.replace(document.referrer);</script>";
				// 下面的 result 回傳 success2 是為了讓主留言跟副留言 AJAX 的時候有所區分
				$arr = array('result'=>'success2',"userid"=>$data["id"],'username'=>$username,'time'=>$time,'major'=>$major2,"num"=>$num);
				echo json_encode($arr);
			} else {
				// 因為如果出錯我一定也不會知道問題出在哪QQ
				echo "<script>alert ('一定是哪裡搞錯了QQ');location.replace(document.referrer);</script>";
			}
	    }
	} else if (!isset($_COOKIE["member_id"])) {
		// 如果莫名其妙有留言欄可是又沒有 cookie 的時候
		echo "<script>alert ('小劍獅太多啦!先登入吧~~'); location.href ='login.php';</script>";
	} else {
		// 這個是如果哪裡空空的話
		echo "<script>alert ('你是不是有什麼沒打R~'); location.replace(document.referrer);</script>";
	}

	$conn->close();
	
?>
