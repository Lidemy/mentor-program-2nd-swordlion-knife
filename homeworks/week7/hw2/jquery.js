$(document).ready(e => {
	// submit 普通輸出待辦事項
	$('.submit').click(() => {
		if($('.todo').val()!==''){
			$('ul').append('<div class="todolist-area"><li class="todolist">'+ $('.todo').val() +'</li></div>');
		}
	})
	// 判斷再 ul 裡有沒有勾選 => 把 lsit style 改成黑黑的或空心的
	$('ul').on('click','li', e => {
		if($(e.target).css("list-style-type") == "circle"){
			$(e.target).css("list-style-type","disc");
			$(e.target).attr('id','disc');
		} else if ($(e.target).css("list-style-type") == "disc") {
			$(e.target).css("list-style-type","circle");
			$(e.target).attr('id','circle');
		}
	})
	// 把他加上刪除線之後會造成點選之後沒有選取的情形 => 判斷 parent 也就是 li 的 list style
	$('ul').on('click','s', e => {
		var list = $(e.target).parent();
		if(list.css("list-style-type") == "circle"){
			list.css("list-style-type","disc");
			list.attr('id','disc');
		} else if (list.css("list-style-type") == "disc") {
			list.css("list-style-type","circle");
			list.attr('id','circle');
		}
	})
	// 如果點已完成按鈕 選取每個 li 然後去判斷哪個有勾選哪個沒勾選 去做判斷有沒有完成 
	$('.complete').click(() => {
		$('li').each(function(i) {
			if($(this).css("list-style-type") == "disc") {
				$(this).css("list-style-type","circle");
				if($(this).next().hasClass("pp")) {
					$(this).next().text("已完成");
				} else {
					$(this).parent().append("<p class='pp'>已完成</p>");
				}
				$(this).html("<S>" + $(this).text() + "</S>");
			}
		})
	})
	// 如果點未完成按鈕 選取每個 li 然後去判斷哪個有勾選哪個沒勾選 去做判斷有沒有完成
	$('.notfinish').click(() => {
		$('li').each(function(i) {
			if($(this).css("list-style-type") == "disc") {
				$(this).css("list-style-type","circle");
				if($(this).next().hasClass("pp")) {
					$(this).next().text("未完成");
				} else {
					$(this).parent().append("<p class='pp'>未完成</p>");
				}
				$(this).html( $(this).text());
			}
		})
	})
	// 如果點選刪除按鈕 判斷每個 li 有沒有被選取
	$('.delete').click( () => {
		var r = confirm("確定要刪除嗎~~");
		$('li').each(function(i) {
			if($(this).css("list-style-type") == "disc") {
				if(r) {
					if($(this).next().hasClass("pp") ) {
						$(this).parent().remove();
					} else {
						$(this).parent().remove();
					}
				}
			}
		})
	})
});