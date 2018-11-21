$(document).ready(() => {
	var list = [];
	function addTodo(todo) {
	  	list.push(todo);
	  	render();
	}

	function removeTodo(id) {
	 	list = list.filter((item,index) => index !== id);
	  	render();
	}

	function render(){
	  	$('.todo-list').empty();
	  	$('.todo-list').append(list.map((item,index) => `<div class='list'><li>`+list[index]+`</li><button class="btn btn-primary delete">刪除</button></div>`));
		$('.list').on('click','.delete', e => {
			removeTodo($(e.target).parent().index());
		})
	}
	// submit 普通輸出待辦事項
	$('.submit').click(() => {
		if($('.todo').val()!==''){
			addTodo($('.todo').val());
		}
		$('textarea').val('');
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
		var liststyle = $(e.target).parent();
		if(liststyle.css("list-style-type") == "circle"){
			liststyle.css("list-style-type","disc");
			liststyle.attr('id','disc');
		} else if (list.css("list-style-type") == "disc") {
			liststyle.css("list-style-type","circle");
			liststyle.attr('id','circle');
		}
	})
	// 如果點已完成按鈕 選取每個 li 然後去判斷哪個有勾選哪個沒勾選 去做判斷有沒有完成 
	$('.complete').click(() => {
		$('li').each(function(i) {
			if($(this).css("list-style-type") == "disc") {
				$(this).css("list-style-type","circle");
				if($(this).next().next().hasClass("pp")) {
					$(this).next().next().text("已完成");
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
				if($(this).next().next().hasClass("pp")) {
					$(this).next().next().text("未完成");
				} else {
					$(this).parent().append("<p class='pp'>未完成</p>");
				}
				$(this).html( $(this).text());
			}
		})
	})
});