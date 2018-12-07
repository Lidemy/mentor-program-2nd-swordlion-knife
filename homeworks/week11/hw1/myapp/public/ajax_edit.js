$(document).ready(() => {
	$(document).on('click',".dropdown-menu", e => {
		// 編輯最後不AJAX 如果點了確認就還是換頁 結果我最後好像還是 AJAX 了
		if($(e.target).hasClass("editing")) {
			$targetarea = $(e.target).parent().parent().parent().parent();
			$textareavalue = $targetarea.children().eq(-1).text();
			$comment_num = $targetarea.children().eq(1).val();
			$targetarea.children().eq(1).remove();
			$targetarea.children().eq(1).remove();
			$targetarea.append(`
				<form method='POST' action='editing.php' class='comment__sub__message'>
					<textarea class='comment__form__textarea' name='content'>`+$textareavalue+`</textarea>
					<input type='hidden' name='helper' value='`+$textareavalue+`'/>
					<input type='hidden' name='num' value='`+$comment_num+`'/>
					<div class='comment__sub__message'>
						<button type='submit' class='btn btn-primary createcomment'>確認</button>
						<button type='button' class='btn btn-primary createcomment'>取消</button>
					</div>
				</form>`);
			//刪除不換頁 直接AJAX出來 
		} else if ($(e.target).hasClass("deleting")) {
			$targetarea = $(e.target).parent().parent().parent().parent();
			$comment_num = $targetarea.children().eq(1).val();;
			var r = confirm('確定要刪除嗎QQ?');
			if(r) {
				$.ajax ({
					type: 'POST',
					url: 'delete.php',
					data: {
						num : $comment_num
					},
					success: () => {
						if($targetarea.hasClass('comment__main')) {
							$targetarea.parent().remove();
						} else {
							$targetarea.remove();
						}
					}
				})
			}
		} 
	})
	// 編輯後的取消按鈕~~ css 可能用display none 把他藏起來  
	$(document).on('click','.createcomment', e => {
		if($(e.target).text() == "取消") {
			$targetelement = $(e.target).parent().parent().parent();
			$(e.target).parent().parent().remove();
			$targetelement.append("<div class='comment__content'>" + $textareavalue + "</div>");
			$controller = 1;
		}
	})
})
