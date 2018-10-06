document.addEventListener('DOMContentLoaded', () => {
	document.querySelector('.MainArea__AnswerArea').addEventListener('click', e => {
		var InputArea = document.querySelectorAll('.InputArea');
		if(e.target.className === "InputArea") {
			for(var i = 0; i < InputArea.length; i++) {
				InputArea[i].style ="border-color:lightgray;";
			}
			e.target.style = "border-color:orange;";
		}
	})
	document.querySelector('ul').addEventListener('click', e => {
		var Choose = document.getElementsByClassName('add');
		if(e.target.className === "List__label") {
			while(Choose.length > 0) {
				Choose[0].remove();
			}
			e.target.innerHTML += "<div class='add'>●</div>";
		}
	})
})