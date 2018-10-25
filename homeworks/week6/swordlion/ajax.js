$(document).ready(() => {
	$(document).on("submit",".comment__form", e => {
		e.preventDefault();
		var content = $(e.target).find('textarea[name=content]').val();
		var major = $(e.target).find('input[name=major]').val();
		console.log()
		
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
				if(res.result === 'success') {
					$('.main').prepend(`
						<div class='comment-display'>
							<div class="main-list">
								<div class="comment__form__icon">
									<img src='avatar/${id%9}.png' class='comment__form__icon__avatar' />
									<div class="comment__form__icon__userinformation">
									<div class='comment__form__icon__userinformation__username'>${res.username}</div>
										<div class='comment__form__icon__userinformation__created-time'>${res.time}</div>
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
								<div class='comment_content'>${content}</div>
							</div>
							<form class="comment__form adding" action="add_comment.php" method="POST">
								<div class="comment__form__icon marginbottomzero">
									<img src='avatar/${id%9}.png' class='comment__form__icon__avatar avatar__littlesize' />
									<div class="comment__form__icon__userinformation">
										<div class='comment__form__icon__userinformation__username username__littlesize'>${res.username}</div>
									</div>
								</div>
								<input type='hidden' value='${res.num}' name='major'>
								<div class='wrapping'>
									<textarea class="comment__form__textarea" name="content" placeholder="有什麼想法嗎來跟大家說吧!"></textarea>
									<button type="submit" class="btn btn-dark createcomment">留言</button>
								</div>
							</form>
						`)
				}
				if(res.result === 'success2') {
					$('.comment__form.adding').find('input[name=major]').each( function() {
						if($(this).val() == res.major) {
							if($(this).parent().parent().find('div').hasClass('sub_comment')) {
								$(this).parent().parent().children().eq(1).before(`
									<div class='sub_comment adding'>
										<div class="comment__form__icon">
											<img src='avatar/${id%9}.png' class='comment__form__icon__avatar avatar__littlesize' />
											<div class="comment__form__icon__userinformation addedcomment">
												<div class='comment__form__icon__userinformation__username username__littlesize'>${res.username}</div>
												<div class='comment__form__icon__userinformation__created-time'>${res.time}</div>
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
										<div class='comment_content'>${content}</div>
									</div>
								`);
							} else {
								$(this).parent().parent().append(`
									<div class='sub_comment adding'>
										<div class="comment__form__icon">
											<img src='avatar/${id%9}.png' class='comment__form__icon__avatar avatar__littlesize' />
											<div class="comment__form__icon__userinformation addedcomment">
												<div class='comment__form__icon__userinformation__username username__littlesize'>${res.username}</div>
												<div class='comment__form__icon__userinformation__created-time'>${res.time}</div>
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
										<div class='comment_content'>${content}</div>
									</div>
								`)
							}
						}
					})
				};

			}
		});
	})
})
