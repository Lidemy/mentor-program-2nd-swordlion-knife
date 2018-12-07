// 參考其他同學作業 POST GET 
// CSS HTML 命名很亂 寫的簡潔一點
$(document).ready(() => {
	$(document).on("submit",".comment__sub__message",e => {
		e.preventDefault();
		var content = $(e.target).find('textarea[name=content]').val();
		var num = $(e.target).find('input[name=num]').val();
		var helper = $(e.target).find('input[name=helper]').val();
		
		$.ajax ({
			type: 'POST',
			url: 'editing.php',
			data: {
				content: content,
				helper: helper,
				num: num
			},
			success: () => {
				$(e.target).parent().append(`
					<input type='hidden' name='num' value='${num}' />
					<div class="comment__content">${content}</div>
					`)
				$(e.target).remove();
			}
		})
	})
	$(document).on("submit",".comment__form__create", e => {
		e.preventDefault();
		var content = $(e.target).find('textarea[name=content]').val();
		var major = $(e.target).find('input[name=major]').val();
		$(e.target).parent().find('textarea[name=content]').val('');
		$.ajax ({
			type: 'POST',
			url: 'add_comment.php',
			data: {
				content: content ,
				major: major
			},
			success: (resp) => {
				const res = JSON.parse(resp);
				const id = res.userid;
				$('.main').prepend(`
					<div class='comment'>
						<div class="comment__main">
							<div class="comment__icon">
								<img src='avatar/${id%9+1}.png' class='comment__avatar' />
								<div class="comment__userinfo">
									<div class='comment__nickname'>${res.username}</div>
									<div class='comment__createdat'>${res.time}</div>
								</div>
								<div class="dropdown edit">
									<button class="btn btn-dark dropdown-toggle createcomment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									    <div class="dropdown-item editing">編輯</div>
									    <div class="dropdown-item deleting">刪除</div>
									</div>
								</div>
							</div>
							<input type="hidden" name="num" value="${res.num}" />
							<div class='comment__content'>${content}</div>
						</div>
						<form class="comment__sub__form" action="add_comment.php" method="POST">
							<div class="comment__icon ">
								<img src='avatar/${id%9+1}.png' class='comment__avatar avatar__littlesize' />
								<div class="comment__userinfo">
									<div class='comment__nickname username__littlesize'>${res.username}</div>
								</div>
							</div>
							<input type='hidden' value='${res.num}' name='major'>
							<div class='comment__sub__message'>
								<textarea class="comment__form__textarea" name="content" placeholder="有什麼想法嗎來跟大家說吧!"></textarea>
								<button type="submit" class="btn btn-dark createcomment">留言</button>
							</div>
						</form>
					</div>
				`)
			}
		})
	})
})
$(document).on("submit",".comment__sub__form", e => {
		e.preventDefault();
		var content = $(e.target).find('textarea[name=content]').val();
		var major = $(e.target).find('input[name=major]').val();
		$(e.target).parent().find('textarea[name=content]').val('');
		$.ajax ({
			type: 'POST',
			url: 'add_comment.php',
			data: {
				content: content ,
				major: major
			},
			success: (resp) => {
				const res = JSON.parse(resp);
				const id = res.userid;
				$('.comment__sub__form').find('input[name=major]').each( function() {
					if($(this).val() == res.major) {
						if($(this).parent().parent().find('div').hasClass('comment__sub__display')) {
							$(this).parent().parent().children().eq(1).before(`
								<div class='comment__sub__display'>
									<div class="comment__icon">
										<img src='avatar/${id%9+1}.png' class='comment__avatar avatar__littlesize' />
										<div class="comment__userinfo addedcomment">
											<div class='comment__nickname username__littlesize'>${res.username}</div>
											<div class='comment__createdat'>${res.time}</div>
										</div>
										<div class="dropdown edit2">
											<button class="btn btn-dark dropdown-toggle createcomment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											    <div class="dropdown-item editing">編輯</div>
											    <div class="dropdown-item deleting">刪除</div>
											</div>
										</div>
									</div>
									<input type="hidden" name="num" value=${res.num} />
									<div class='comment__content'>${content}</div>
								</div>
							`);
						} else {
							$(this).parent().parent().append(`
								<div class='comment__sub__display'>
									<div class="comment__icon">
										<img src='avatar/${id%9+1}.png' class='comment__avatar avatar__littlesize' />
										<div class="comment__userinfo addedcomment">
											<div class='comment__nickname username__littlesize'>${res.username}</div>
											<div class='comment__createdat'>${res.time}</div>
										</div>
										<div class="dropdown edit2">
											<button class="btn btn-dark dropdown-toggle createcomment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											    <div class="dropdown-item editing">編輯</div>
											    <div class="dropdown-item deleting">刪除</div>
											</div>
										</div>
									</div>
									<input type="hidden" name="num" value=${res.num} />
									<div class='comment__content'>${content}</div>
								</div>
							`)
						}
					}
				})
			}
		})
})
