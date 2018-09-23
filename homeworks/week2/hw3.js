function isPrime(n) {
  	for (var i = 2; i <= n; i++ ) {
  		if (n%i == 0 && n != i) {
  			return false;
  		}
  		return true;
  	}
  	return false;
}

module.exports = isPrime