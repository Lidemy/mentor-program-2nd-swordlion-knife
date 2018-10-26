var zerosupport = require('./hw5sup')


function add(a, b) {
	//先將小數左邊填滿0
	(parseInt(a) > parseInt(b)) ? b = zerosupport(a,b) : a = zerosupport(a,b);

	var str1 = '';
	var length = a.length;
	var carry = 0;
	for(var i = 0; i <= length; i++ ) {
		//加法的4種可能性, 第五種是假設兩數相加多一位的可能性。 例:79 + 21 = 100 兩位加兩位會變三位的可能性
		if (carry == 0 && parseInt(a[length-i-1])+parseInt(b[length-1-i]) < 10) {
			str1 += parseInt(a[length-i-1])+parseInt(b[length-1-i]);
		} else if (carry == 0 && parseInt(a[length-i-1])+parseInt(b[length-1-i]) >= 10) {
			str1 += parseInt(a[length-i-1])+parseInt(b[length-1-i])-10;
			carry = 1;
		} else if (carry == 1 && parseInt(a[length-i-1])+parseInt(b[length-1-i]) + 1 < 10) {
			str1 += parseInt(a[length-i-1])+parseInt(b[length-1-i]) + 1;
			carry = 0;
		} else if (carry == 1 && parseInt(a[length-i-1])+parseInt(b[length-1-i]) + 1 >= 10) {
			str1 += parseInt(a[length-i-1])+parseInt(b[length-1-i]) + 1 - 10;
			carry = 1;
		} else if (carry ==1 && length-i-1 < 0) {
			str1 += 1;
			carry = 0;
		}
	}
	return str1.split('').reverse().join('');
}

module.exports = add;