function bigAdd(str, str1) {
	var strArray = [];
	var str1Array = [];
	if(str.length > str1.length) {
		str1Array = zerosupport(str,str1).reverse();
		for(var i = 0; i < str.length; i++ ) {
			strArray[i] = str[str.length-i-1];
		}
	} else {
		strArray = zerosupport(str,str1).reverse();
		for(var i = 0; i < str1.length; i++ ) {
			str1Array[i] = str1[str1.length-i-1];
		}
	}
	var outputArray = [];
	var LargeNum = (str.length > str1.length) ? str.length : str1.length;
	for(var a = 0 ; a < LargeNum; a++) {
		outputArray[a] = parseInt(strArray[a]) + parseInt(str1Array[a]);
	}
	for(var b = 0; b < outputArray.length; b++) {
		if(outputArray[b] > 9) {
			var adding = (outputArray[b] - (outputArray[b] % 10))/10;
			outputArray[b] =  outputArray[b] % 10;
			if(outputArray[b+1]) {
				outputArray[b+1] += adding;
			} else {
				outputArray[b+1] = adding;
			}
		}
	}
	return outputArray.reverse().join('');
}

function zerosupport(str,str1) {
	var smallNum = [];
	if(str.length > str1.length) {
		for (var i = 0; i < str.length;i++) {
			smallNum[i] = (str.length-str1.length-i > 0) ?  0 : str1[i-(str.length-str1.length)] ;
		}

	} else {
		for (var i = 0; i < str1.length;i++) {
			smallNum[i] = (str1.length-str.length-i > 0) ?  0 : str[i-(str1.length-str.length)] ;
		}
	}
	return smallNum;
}

