function zerosupport(a,b) {
	var str = '';
	if(parseInt(a) > parseInt(b)) {
		for (var i = 0; i < a.length;i++) {
			(a.length-b.length-i > 0) ? str += 0 : str += b[i-(a.length-b.length)] ;
		}

	} else {
		for (var i = 0; i < b.length;i++) {
			(b.length-a.length-i > 0) ? str += 0 : str += a[i-(b.length-a.length)] ;
		}
	}
	return str;
}


module.exports = zerosupport;