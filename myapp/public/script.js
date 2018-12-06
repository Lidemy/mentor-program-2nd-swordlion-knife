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
		window.location = '/logout';
	})
	$(".comment__form__button").click(e => {
		if(e.target.innerText == "還沒有帳號嗎QQ") {
			window.location="register";
		} else if(e.target.innerText == "我已經有帳號了!") {
			window.location="login";
		}
	})
})
	// 這是網頁最下面的日期更新
ShowTime = () => {
　	var Today = new Date();
	document.getElementById('showbox').innerHTML = Today.getFullYear() + " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日 , 今天開始加油吧😊";
	setTimeout('ShowTime()',3600*24);
}