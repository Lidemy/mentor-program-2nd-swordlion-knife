$controller = 0;
$(document).ready(() => {
	$(document).on('click',".dropdown-menu", e => {
		if(e.target.className == "dropdown-item editing" && !$controller == 1) {
			$controller = 1 ;
			$targetarea = e.target.parentNode.parentNode.parentNode.parentNode;
			$textareavalue = $targetarea.lastChild.previousSibling.innerText;
			$comment_num = $targetarea.lastChild.previousSibling.previousSibling.previousSibling.value;
			$targetarea.lastChild.previousSibling.remove();
			$targetarea.innerHTML += (`
				<form method='POST' action='editing.php' class='wrapping'>
					<textarea class='comment__form__textarea' name='content'>`) + $textareavalue + (`</textarea>
					<input type='hidden' name='helper' value='`) + $textareavalue + (`'/>
					<input type='hidden' name='num' value='`) + $comment_num + (`'/>
					<div class='wrapping'>
						<button type='submit' class='btn btn-primary createcomment'>確認</button>
						<button type='button' class='btn btn-primary createcomment'>取消</button>
					</div>
				</form>`);
		} else if (e.target.className == "dropdown-item editing" && $controller == 2) {
			$controller = 1 ;
			$targetarea = e.target.parentNode.parentNode.parentNode.parentNode;
			$textareavalue = $targetarea.lastChild.innerText;
			$comment_num = $targetarea.lastChild.previousSibling.previousSibling.value;
			$targetarea.lastChild.remove();
			$targetarea.innerHTML += (`
				<form method='POST' action='editing.php' class='wrapping'>
					<textarea class='comment__form__textarea' name='content'>`) + $textareavalue + (`</textarea>
					<input type='hidden' name='helper' value='`) + $textareavalue + (`'/>
					<input type='hidden' name='num' value='`) + $comment_num + (`'/>
					<div class='wrapping'>
						<button type='submit' class='btn btn-primary createcomment'>確認</button>
						<button type='button' class='btn btn-primary createcomment'>取消</button>
					</div>
				</form>`);
		} else if (e.target.className == "dropdown-item deleting") {
			$targetarea = e.target.parentNode.parentNode.parentNode.parentNode;
			$comment_num = $targetarea.lastChild.previousSibling.previousSibling.previousSibling.value;
			var r = confirm('確定要刪除嗎QQ?');
			if(r) {
				document.cookie= "temporary=" + $comment_num;
				window.location="delete.php";
			}
		}
	})

	$(document).on('click','.createcomment', e => {
		if(e.target.innerText == "取消") {
			$targetelement = e.target.parentNode.parentNode.parentNode;
			e.target.parentNode.parentNode.remove();
			$targetelement.innerHTML += "<div class='comment_content'>" + $textareavalue + "</div>";
			$controller = 2;
		}
	})

	$(".buttoncenter").click(e => {
		if(e.target.innerText == "還沒有帳號嗎QQ") {
			window.location="register.php";
		} else if(e.target.innerText == "我已經有帳號了!") {
			window.location="login.php";
		}
	})
})

ShowTime = () => {
　	var Today = new Date();
	document.getElementById('showbox').innerHTML = Today.getFullYear() + " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日 , 今天開始加油吧😊";
	setTimeout('ShowTime()',3600*24);
}