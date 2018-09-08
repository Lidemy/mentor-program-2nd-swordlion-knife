function printFactor(n) {
	var str = [];
	for (var a = 1; a <= n; a++) {
		var b = n%a;
		if (b == 0) {
			console.log(a);
		}
	}
}