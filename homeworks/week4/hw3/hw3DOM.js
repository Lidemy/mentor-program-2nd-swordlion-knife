var text = "";
var array = [];
var url = [];
document.addEventListener('DOMContentLoaded' , function () {
	/*向網站發送request XMLHttpRequest() function
	var request = new XMLHttpRequest();
	request.open('想採取的形式',"這邊是網站位址",最後面的true代表非同步)
	request.setRequestHeader('這邊是要放要設置的header','這邊是數值')
	request.onload =  function () 這邊接下來是要寫開啟之後要存取的事情 {}
	*/
	var request = new XMLHttpRequest();
	request.open('get','https://api.twitch.tv/kraken/streams?game=League%20of%20Legends&limit=20' ,true);
	request.setRequestHeader('Client-ID', 'nw4wklhsuzrv6qlmi2ck1hbvhz9vf8');
	request.onload = () => {
		// 200 <= request.status <= 400 代表正常
		if(request.status >= 200 && request.status < 400) {
			var resp = request.responseText;
			var posts = JSON.parse(resp).streams;
			var ContentArea = document.querySelectorAll(".DisplayArea__ContentArea");
			var Pic = document.querySelectorAll(".DisplayArea__ContentArea__Pic");
			var LogoDescription = document.querySelectorAll(".DisplayArea__ContentArea__LogoDescription");
			for ( var a = 0; a < 20; a++) {
				if(posts[a]["channel"]["status"].length > 23) {
					text = posts[a]["channel"]["status"];
				}
			    for(var b= 0; b< 17; b++) {
					array[b] = text[b];
				}
				array[17] = '...';
				ContentArea[a].index=a;
				for (var c = 0; c < 20 ; c++) {
					url[c] = posts[c]["channel"]["url"];
				}
				Pic[a].innerHTML += "<img id='pic'src='"+ posts[a]["preview"]["medium"] + "'></img>";
				LogoDescription[a].innerHTML += "<img class='DisplayArea__ContentArea__livesmall' src='"+ posts[a]["channel"]["logo"] + "'> </img>";
				LogoDescription[a].innerHTML += "<div class='DisplayArea__ContentArea__text'>"+ array.join('') + "<br>" + posts[a]["channel"]["display_name"] + "</div>";
			}
		}
	}
	document.querySelector('.DisplayArea').addEventListener('click' , e => {
		if (e.target.className =='DisplayArea__ContentArea'){
			window.location = url[e.target.index];
		}
		if (e.target.className =='DisplayArea__ContentArea__livesmall' || e.target.className == 'DisplayArea__ContentArea__text') {
			window.location = url[e.target.parentNode.parentNode.index];
		}
		if (e.target.id == 'pic') {
			window.location = url[e.target.parentNode.parentNode.index];
		}
	})
	request.onerror = function() {
	};
	request.send();
})