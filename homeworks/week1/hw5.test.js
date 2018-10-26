import {join,repeat} from './hw5.js'

describe("hw5", () => {
	it("should return correct answer when str= [1, 2, 3] ,contacStr= ''", () => {
   	 	expect(join([1, 2, 3], '')).toEqual("123");
  	})
  	it("should return correct answer when str= ['a', 1, 'b', 2, 'c', 3] ,contacStr= ','", () => {
   	 	expect(join(["a", 1, "b", 2, "c", 3], ',')).toEqual("a,1,b,2,c,3");
  	})
  	it("should return correct answer when str= ['a', 'b', 'c'] ,contacStr= '!'", () => {
   	 	expect(join(["a", "b", "c"], "!")).toEqual("a!b!c");
  	})
  	it("should return correct answer when str= 'a' ,times= 5", () => {
   	 	expect(repeat('a', 5)).toEqual("aaaaa");
  	})
  	it("should return correct answer when str= 'yoyo' ,times= 2", () => {
   	 	expect(repeat('yoyo', 2)).toEqual("yoyoyoyo");
  	})
})