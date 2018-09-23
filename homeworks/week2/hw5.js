function add(a, b) {
	var ans = '';
	var carry = 0;
	if (a > b) {
		for (var i = 0; i < b.length; i++ ) {
			if(a[a.length-i-1] + b[b.length-i-1] + carry >= 10) {
				ans += a[a.length-i-1] + b[b.length-i-1] + carry - 10;
			} else {
				ans += a[a.length-i-1] + b[b.length-i-1];
				carry = 0;
			}
			ans += a[a.length-i-1] + b[b.length-i-1];
		}
		for (var c = b.length; c < a.length; c++ ) {
			ans += a[a.length-c-1]
		}
	} else {
		
	}
console.log (add(23,56))
module.exports = add;