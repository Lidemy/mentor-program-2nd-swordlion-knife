function zerosupport(a,b) {
	var str = '';
	if(parseInt(a) > parseInt(b)) {
		for (var i = 0; i < a.length;i++) {
			(b[b.length-i-1] == true) ? str += b[b.length-i-1] : str += 0 ;
		}
	} else {
		for (var i = 0; i < b.length;i++) {
			(a[a.length-i-1] == true) ? str += a[a.length-i-1] : str += 0 ;
		}
	}
	return str;
}

console.log(zerosupport(221,2))

module.exports = zerosupport;