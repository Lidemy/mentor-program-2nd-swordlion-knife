import {capitalize} from './hw2.js'

describe("hw2", () => {
	it("should return correct answer when n = nick", () => {
   	 	expect(capitalize("nick")).toEqual("Nick");
  	})
  	it("should return correct answer when n = ,nick", () => {
    	expect(capitalize(",nick")).toEqual(",nick");
 	})
 	it("should return correct answer when n = Nick", () => {
    	expect(capitalize("Nick")).toEqual("Nick");
 	})
})