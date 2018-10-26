function stars(n) {
	var star = [];
	for (var i = 0; i < n ; i++) {
		star[i] = '*'.repeat(i+1);
	}
	return star;
}
module.exports = stars;