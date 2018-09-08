import {printStars} from './hw1.js'

describe("hw1", () => {
	it("should return correct answer when n = 1", () => {
    	expect(printStars(1)).toEqual("*");
  	})
  	it("should return correct answer when n = 3", () => {
  		expect(printStars(3)).toEqual("*\n*\n*");
  	})
})