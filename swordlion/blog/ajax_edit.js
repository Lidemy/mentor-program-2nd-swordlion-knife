$(document).ready(() => {
	$(document).on('click',".dropdown-menu", e => {
		var spliter = location.href.split('?article=');
		// 編輯最後不AJAX 如果點了確認就還是換頁 結果我最後好像還是 AJAX 了
		if($(e.target).hasClass("editing")) {
			$targetarea = $(e.target).parent().parent().parent().parent();
			if($targetarea.hasClass("article__area")) {
				$title = $targetarea.children().eq(1).text();
				$content = $targetarea.children().eq(2).text();
				$num = spliter[1];
				$targetarea.children().eq(-1).remove();
				$targetarea.children().eq(-1).remove();
				$targetarea.append(`
					<form class='create__article__editing' method="POST" action='editing_article.php'>
						<div>修改文章 : 文章編號 `+$num+`</div>
						<input name='title' class='create__title' value='`+$title+`' />
						<div class="dropdown">
							<button class="btn btn-dark dropdown-toggle createcomment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">😄
							</button>
							<div class="dropdown-menu main" aria-labelledby="dropdownMenuButton">
							</div>
						</div>
						<textarea name='content' class='create__content'>`+nl2br($content)+`</textarea>
						<input name='num' type='hidden' value='`+$num+`' / >
						<button type='submit' class='btn btn-primary create__submitButton'>修改文章</button>
						<button type='button' class='btn btn-primary create__submitButton'>取消修改</button>
					</form>
				`);
			} else if($targetarea.hasClass("subcomment")) {
				$content = $targetarea.children().eq(-1).text();
				$num = $targetarea.children().eq(1).val();
				$targetarea.children().eq(-1).remove();
				$targetarea.append(`
					<form method='POST' action='editing_sub.php' class='subcomment__form'>
						<textarea class='leavecomment__textarea' name='content'>`+nl2br($content)+`</textarea>
						<input type='hidden' name='num' value='`+$num+`'/>
						<button type='submit' class='btn btn-primary create__submitButton'>修改留言</button>
						<button type='button' class='btn btn-primary create__submitButton'>不改了</button>
					</form>
				`);
			}
		} else if ($(e.target).hasClass("deleting")) {
			var r = confirm('確定要刪除嗎QQ?');
			if(r) {
				$.ajax ({
					type: 'POST',
					url: 'delete.php',
					// data:
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
	$(document).on('click','.create__submitButton', e => {
		if($(e.target).text() == "修改文章") {
			e.preventDefault();
			$title = $(e.target).parent().find('input[name=title]').val();
			$content = $(e.target).parent().find('textarea[name=content]').val();
			$num = $(e.target).parent().find('input[name=num]').val();

			$.ajax ({
				type : 'POST',
				url : 'editing_article.php',
				data : {
					title : $title ,
					content : $content ,
					num : $num
				},
				success: () => {
					$(e.target).parent().parent().append(`
						<h>`+$title+`</h>
						<p>`+nl2br($content)+`</p>
					`)
					$(e.target).parent().remove();
				}
			})
		}
		if($(e.target).text() == "修改留言") {
			e.preventDefault();
			$content = $(e.target).parent().find('textarea[name=content]').val();
			$num = $(e.target).parent().find('input[name=num]').val();

			$.ajax ({
				type : 'POST',
				url : 'editing_sub.php',
				data : {
					content : $content ,
					num : $num
				},
				success: () => {
					$(e.target).parent().parent().append(`
						<p>`+$content+`</p>
					`)
					$(e.target).parent().remove();
				}
			})
		}
		if($(e.target).text() == "取消") {
			$targetelement = $(e.target).parent().parent();
			$(e.target).parent().remove();
			$targetelement.append(`
				<h>`+$title+`</h>
				<p>`+nl2br($content)+`</p>
			`);
		}
		if($(e.target).text() == "不改了") {
			$targetelement = $(e.target).parent().parent();
			$(e.target).parent().remove();
			$targetelement.append(`
				<p>`+nl2br($content)+`</p>
			`);
		}
	})
function nl2br (str, is_xhtml) {   
  	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
		return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
	}
})
