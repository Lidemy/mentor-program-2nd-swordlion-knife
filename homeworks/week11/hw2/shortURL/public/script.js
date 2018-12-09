ShowTime = () => {
　	var Today = new Date();
	document.getElementById('showbox').innerHTML = Today.getFullYear() + " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日 , 今天開始加油吧😊";
	setTimeout('ShowTime()',3600*24);
}