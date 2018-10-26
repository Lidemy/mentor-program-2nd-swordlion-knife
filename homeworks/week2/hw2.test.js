var alphaSwap = require('./hw2')

describe("hw2", function() {
  it("should return correct answer when str = nick", function() {
    expect(alphaSwap('nick')).toBe('NICK')
  })
  it("should return correct answer when str = NICK", function() {
    expect(alphaSwap('Nick')).toBe('nICK')
  })
  it("should return correct answer when str = ,hEllO122", function() {
    expect(alphaSwap(',hEllO122')).toBe(',HeLLo122')
  })
})