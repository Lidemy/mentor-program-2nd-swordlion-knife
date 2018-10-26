import {reverse} from './hw3.js'

describe("hw3", () => {
	it("should return correct answer when n = yoyoyo", () => {
   	 	expect(reverse("yoyoyo")).toEqual("oyoyoy");
  	})
  	it("should return correct answer when n = 1abc2", () => {
   	 	expect(reverse("1abc2")).toEqual("2cba1");
  	})
  	it("should return correct answer when n = 1,2,3,2,1", () => {
   	 	expect(reverse("1,2,3,2,1")).toEqual("1,2,3,2,1");
  	})
})