function isPalindromes(str) {
  	var str1 = '';
  	for (var i = 1; i <= str.length; i++ ) {
  		str1 += str[str.length-i];
  	}
    return str1 === str;
  	
}
module.exports = isPalindromes