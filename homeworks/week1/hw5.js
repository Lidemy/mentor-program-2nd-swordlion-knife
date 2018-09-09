export const join = (str, concatStr) => {
	var ans = [];
	for (var i = 0; i < str.length-1; i++) {
		ans += str[i] + concatStr;
	}
	ans += str[str.length-1];

	return ans;
}

export const repeat = (str, times) => {
 	var ans = [];
 	for (var i =0 ; i < times; i++) {
 		ans += str;
 	}
 	return ans;
}