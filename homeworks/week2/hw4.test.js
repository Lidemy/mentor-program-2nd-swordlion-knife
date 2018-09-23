var isPalindromes = require('./hw4')

describe("hw4", function() {
  it("should return correct answer when str = abcdcba", function() {
    expect(isPalindromes('abcdcba')).toBe(true)
  })
  it("should return correct answer when str = apple", function() {
    expect(isPalindromes('apple')).toBe(false)
  })
  it("should return correct answer when str = 1aca1", function() {
    expect(isPalindromes('1aca1')).toBe(true)
  })
})