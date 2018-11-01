$(document).ready(() => {
	/* 舊的編輯刪除功能 -> ajax.js 想辦法用ajax呈現
	$(document).on('click',".dropdown-menu", e => {
		// 不知道為啥 編輯過後 總會少一個元素
		if(e.target.className == "dropdown-item editing" && !$controller == 1) {
			$controller = 1 ;
			$controller2 = 1 ;
			$targetarea = e.target.parentNode.parentNode.parentNode.parentNode;
			$textareavalue = $targetarea.lastChild.previousSibling.innerText;
			$comment_num = $targetarea.lastChild.previousSibling.previousSibling.previousSibling.value;
			$targetarea.lastChild.previousSibling.remove();
			$targetarea.innerHTML += (`
				<form method='POST' action='editing.php' class='wrapping'>
					<textarea class='comment__form__textarea' name='content'>`+$textareavalue+`</textarea>
					<input type='hidden' name='helper' value='`+$textareavalue+`'/>
					<input type='hidden' name='num' value='`+$comment_num+`'/>
					<div class='wrapping'>
						<button type='submit' class='btn btn-primary createcomment'>確認</button>
						<button type='button' class='btn btn-primary createcomment'>取消</button>
					</div>
				</form>`);
			//所以這邊如果編輯過就要重選
		} else if (e.target.className == "dropdown-item editing" && $controller == 2) {
			$controller = 1 ;
			$controller2 = 1 ;
			$targetarea = e.target.parentNode.parentNode.parentNode.parentNode;
			$textareavalue = $targetarea.lastChild.innerText;
			$comment_num = $targetarea.lastChild.previousSibling.previousSibling.value;
			$targetarea.lastChild.remove();
			$targetarea.innerHTML += (`
				<form method='POST' action='editing.php' class='wrapping'>
					<textarea class='comment__form__textarea' name='content'>`+$textareavalue+`</textarea>
					<input type='hidden' name='helper' value='`+$textareavalue+`'/>
					<input type='hidden' name='num' value='`+$comment_num+`'/>
					<div class='wrapping'>
						<button type='submit' class='btn btn-primary createcomment'>確認</button>
						<button type='button' class='btn btn-primary createcomment'>取消</button>
					</div>
				</form>`);
		//這個也是跟上面一樣
		} else if (e.target.className == "dropdown-item deleting" && $controller2 == 0) {
			$targetarea = e.target.parentNode.parentNode.parentNode.parentNode;
			$comment_num = $targetarea.lastChild.previousSibling.previousSibling.previousSibling.value;
			var r = confirm('確定要刪除嗎QQ?');
			if(r) {
				document.cookie= "temporary=" + $comment_num;
				window.location.href='delete.php';
			}
			//刪除2
		} else if (e.target.className == "dropdown-item deleting" && $controller2 == 2) {
			$targetarea = e.target.parentNode.parentNode.parentNode.parentNode;
			$comment_num = $targetarea.lastChild.previousSibling.previousSibling.value;
			var r = confirm('確定要刪除嗎QQ?');
			if(r) {
				document.cookie= "temporary=" + $comment_num;
				window.location.href='delete.php';
			}
		}
	}) */
	/* 案過取消後元素會消失的情形
	$(document).on('click','.createcomment', e => {
		if(e.target.innerText == "取消") {
			$targetelement = e.target.parentNode.parentNode.parentNode;
			e.target.parentNode.parentNode.remove();
			$targetelement.innerHTML += "<div class='comment_content'>" + $textareavalue + "</div>";
			$controller = 2;
			$controller2 = 2;
		}
	}) */
	// 登入註冊導向
	$(".logout").click( e => {
		document.cookie="member_id=;";
		document.cookie="member_nickname=;";
		window.location.reload();
	})
	$(".buttoncenter").click(e => {
		if(e.target.innerText == "還沒有帳號嗎QQ") {
			window.location="register.php";
		} else if(e.target.innerText == "我已經有帳號了!") {
			window.location="login.php";
		}
	})
	// 網路頁面導向 (換頁功能)
	var actual_link = location.href;
	var pagenum = actual_link.split('page=')[1];
	var pagelength = document.querySelectorAll('.page').length;
	var page = document.querySelectorAll('.page');
	if(!pagenum) {
		page[0].style = 'font-size:30px;';
	} else {
		page[pagenum-1].style = 'font-size:30px;';
	}
	$('.pageContainer').on('mouseover','.page', e => {
		for(var i = 0; i < pagelength; i++) {
			document.querySelectorAll('.page')[i].style = 'font-size:20px;';
		}
		e.target.style = 'font-size:30px;';
	})
	//這邊想用get method 把網址PO上去 但不用會QQ
	$('.pageContainer').on('click','.page',e => {
		window.location.href="index.php?page=" + e.target.innerText;
	})
	$('.pageContainer').on('click','.previous',e => {
		if(parseInt(pagenum) - 1 > 0) {
			window.location.href="index.php?page=" + (parseInt(pagenum)-1);
		}
	})
	$('.pageContainer').on('click','.next',e => {
		if(parseInt(pagenum) + 1 <= pagelength) {
			window.location.href="index.php?page=" + (parseInt(pagenum)+1);
		} else if(!pagenum) {
			window.location.href="index.php?page=2";
		}
	})
})

	// 這是網頁最下面的日期更新
ShowTime = () => {
　	var Today = new Date();
	document.getElementById('showbox').innerHTML = Today.getFullYear() + " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日 , 今天開始加油吧😊";
	setTimeout('ShowTime()',3600*24);
}