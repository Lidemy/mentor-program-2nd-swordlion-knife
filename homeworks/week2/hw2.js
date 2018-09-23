 function alphaSwap(str) {
	var str1 = '';
	for (var i = 0; i < str.length; i++) {
		(str[i] >= 'A' && str[i] <= 'Z') ? str1 += str[i].toLowerCase() : str1 += str[i].toUpperCase();
	}
	return str1;
} 

/*  first thought
function alphaSwap(str) {
	var str1 = '';
	for (var i = 0; i < str.length; i++) {
		if(str[i] >= 'A' && str[i] <= 'Z') {
			str1 += str[i].toLowerCase();
		} else {
			str1 += str[i].toUpperCase();
		}

	}
	return str1;
} */


module.exports = alphaSwap