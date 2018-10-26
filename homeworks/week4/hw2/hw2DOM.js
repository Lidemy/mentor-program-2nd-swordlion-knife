document.addEventListener('DOMContentLoaded', () => {
	document.querySelector('.MainArea__AnswerArea').addEventListener('click', e => {
		var InputArea = document.querySelectorAll('.InputArea');
		var warningsign = document.getElementsByClassName('warningsign');
		var Choose = document.getElementsByClassName('add');
		var List = document.getElementsByClassName('List');
		if(e.target.className === "InputArea") {
			for(var i = 0; i < InputArea.length; i++) {
				InputArea[i].style = "border-color:lightgray;";
			}
			e.target.style = "border-color:orange;";
		}
		if(e.target.className === "submit") {
			while(warningsign.length > 0) {
				warningsign[0].remove();
			}
			for(var i = 0; i < InputArea.length; i++) {
				InputArea[i].parentNode.style = "background:none;border:none;";
				if(!InputArea[i].value) {
					InputArea[i].parentNode.style = "background-color:#eaa6a6;border: 0.5px solid darkgray;";
					InputArea[i].parentNode.innerHTML += "<div class='warningsign'>必填 *</div>";
				}
			}
			if(Choose.length == 0) {
				console.log(List);
				List[0].parentNode.parentNode.style = "background-color:#eaa6a6;border: 0.5px solid darkgray;";
				List[0].parentNode.parentNode.innerHTML += "<div class='warningsign'>必填 *</div>";
			}
			if(warningsign.length == 0 && document.getElementsByClassName('add').length > 0) {
				alert("success!");
				var Question = document.getElementsByClassName('MainArea__AnswerArea__Question');
				for(var i = 0; i < InputArea.length; i++) {
					console.log(Question[i].innerText,":",InputArea[i].value);
				}
			}
		}
		if(e.target.className === "List__label") {
			while(Choose.length > 0) {
				Choose[0].remove();
			}
			e.target.innerHTML += "<div class='add'>●</div>";
		}
	})
})