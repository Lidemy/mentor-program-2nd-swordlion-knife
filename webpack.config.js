const path = require('path');

module.exports = {
  entry: './homeworks/week10/hw2/webpack/index.js',
  output: {
    path: path.resolve(__dirname, './homeworks/week10/hw2/webpack'),
    filename: 'bundle.js'
  }
};