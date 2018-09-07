export const join = (str, concatStr) => {
	var ans = [];
	for (var a = 0; a < str.length-1; a++) {
		ans += str[a] + concatStr;
	}
	ans += str[str.length-1];

	return ans;
}

export const repeat = (str, times) => {
 	var ans = [];
 	for (var a =0 ; a < times; a++) {
 		ans += str;
 	}
 	return ans;
}