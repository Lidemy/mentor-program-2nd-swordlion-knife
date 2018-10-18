$(document).ready(() => {
	$(".dropdown-menu").click( e => {
		if(e.target.className == "dropdown-item editing") {
			$targetarea = e.target.parentNode.parentNode.parentNode.parentNode;
			$textareavalue = $targetarea.lastChild.previousSibling.innerText;
			$comment_num = $targetarea.lastChild.previousSibling.previousSibling.previousSibling.value;
			$targetarea.lastChild.previousSibling.remove();
			$targetarea.innerHTML += "<form method='POST' action='editing.php' class='wrapping'><textarea class='comment__form__textarea' name='content'>"+$textareavalue+"</textarea><input type='hidden' name='helper' value='" + $textareavalue + "'/><input type='hidden' name='num' value='" + $comment_num + "'/><button type='submit' class='btn btn-dark createcomment'>留言</button></form>";
		} else if (e.target.className == "dropdown-item deleting") {
			$targetarea = e.target.parentNode.parentNode.parentNode.parentNode;
			$comment_num = $targetarea.lastChild.previousSibling.previousSibling.previousSibling.value;
			var r = confirm('確定要刪除嗎QQ?');
			if(r) {
				document.cookie= "temporary="+$comment_num;
				window.location="delete.php";
			}

		}
	})
})