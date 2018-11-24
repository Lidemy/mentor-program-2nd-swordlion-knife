$(document).ready(() => {
	$(document).on('click','.createcomment', e => {
		if(e.target.innerText == "取消") {
			$targetelement = e.target.parentNode.parentNode.parentNode;
			e.target.parentNode.parentNode.remove();
			$targetelement.innerHTML += "<div class='comment__content'>" + $textareavalue + "</div>";
			$controller = 2;
			$controller2 = 2;
		}
	}) 
	$(".logout").click( e => {
		document.cookie="member_id=;";
		document.cookie="member_nickname=;";
		window.location.reload();
	})
	$(".comment__form__button").click(e => {
		if(e.target.innerText == "還沒有帳號嗎QQ") {
			window.location="register";
		} else if(e.target.innerText == "我已經有帳號了!") {
			window.location="login";
		}
	})
	// 網路頁面導向 (換頁功能)
	var actual_link = location.href;
	var pagenum = actual_link.split('page=')[1];
	var pagelength = document.querySelectorAll('.changePageContainer__page').length;
	var page = document.querySelectorAll('.changePageContainer__page');
	if(!pagenum) {
		page[0].style = 'font-size:30px;';
	} else {
		page[pagenum-1].style = 'font-size:30px;';
	}
	$('.changePageContainer').on('mouseover','.page', e => {
		for(var i = 0; i < pagelength; i++) {
			document.querySelectorAll('.changePageContainer__page')[i].style = 'font-size:20px;';
		}
		e.target.style = 'font-size:30px;';
	})
	//這邊想用get method 把網址PO上去 但不用會QQ (問題~)
	$('.changePageContainer').on('click','.changePageContainer__page',e => {
		window.location.href="index.php?page=" + e.target.innerText;
	})
	$('.changePageContainer').on('click','.changePageContainer__previous',e => {
		if(parseInt(pagenum) - 1 > 0) {
			window.location.href="index.php?page=" + (parseInt(pagenum)-1);
		}
	})
	$('.changePageContainer').on('click','.changePageContainer__next',e => {
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