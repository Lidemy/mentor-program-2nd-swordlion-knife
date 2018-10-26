export const printStars = (n) => {
	var str = "*";
	for (var i = 1 ; i < n; i++) {
		str = str + "\n*";
	}
	console.log(str);
	return str;
}