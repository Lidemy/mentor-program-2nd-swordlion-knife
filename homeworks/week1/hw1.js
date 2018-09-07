function printStars(n) {
	var str = "*";
	for (var a = 1 ; a < n; a++) {
		str = str + "\n*";
	}
	return str;
    console.log(printStars(n));
}