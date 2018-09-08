export const reverse = (str) => {
	var str1 = [];
	for (var a = 1 ; a <= str.length; a++) {
		str1 += str[str.length-a];
	}
	return str1;
}