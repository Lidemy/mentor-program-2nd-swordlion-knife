document.addEventListener('DOMContentLoaded',()=>{
	document.querySelector('.stack_push').addEventListener('click',() => {
		var number = document.querySelector('textarea').value;
		if(number){
			Stack().push(number);
		}
		document.querySelector('textarea').value = '';
	})
	document.querySelector('.queue_push').addEventListener('click',() => {
		var number = document.querySelector('textarea').value;
		if(number){
			Queue().push(number);
		}
		document.querySelector('textarea').value = '';
	})
	document.querySelector('.stack_pop').addEventListener('click',() => {
		document.querySelector('.output').innerText += "stack.pop() 答案是 =>"+ Stack().pop() + '\n';
	})
	document.querySelector('.queue_pop').addEventListener('click',() => {
		document.querySelector('.output').innerText += "queue.pop() 答案是 =>"+ Queue().pop() + '\n';
	})

})
var stack = new Array();
Stack = () => {
	return {
		push: (n) => {
			stack[stack.length] = n;
			console.log("stack = "+stack);
		},
		pop: () => {
			console.log(stack[stack.length-1]);
			var text = stack[stack.length-1];
			stack = stack.slice(0,-1); 
			return text;
		}
	}
}
var queue = new Array();
Queue = () => {
	return {
		push: (n) => {
			queue[queue.length] = n;
			console.log("queue = "+ queue);
		},
		pop: (n) => {
			console.log(queue[0]);
			var text = queue[0];
			queue = queue.slice(1); 
			return text;
		}
	}
}