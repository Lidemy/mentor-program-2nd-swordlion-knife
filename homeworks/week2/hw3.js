function isPrime(n) {
	var controller = 0;
  	for (var i = 2; i <= n; i++ ) {
  		if (n%i == 0 && n != i) {
  			controller = 1;
  		}
  	}
  	if (controller == 0 && n != 1) {
  		return true;
  	} 
    return false;
}

module.exports = isPrime