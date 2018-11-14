### console.log(1)

	1. 在 console 輸出 1

### setTimeout(() => { console.log(2) }, 0)

	4. 這邊用 setTimeout 他會把這個 call back function 放到 WebApis 裡面，因為設定是零秒，好了之後他會把這個 cb 放到 Callback Queue 裡面等待，Call Stack 裡面的東西跑完之後最後再放上去。
	這是非同步 (asynchronous) 的用法，讓他在跑一些類似 AJAX 或是 DOM 的時候不會 BLOCK 到其他 Stack 的進行。

	也因此在這個 setTimeout 之前 console.log 1.3.5 會先輸出完。


### console.log(3)

	2. 在 console 輸出 3

### setTimeout(() => { console.log(4) }, 0)

	5. 這個非同步會排在 Callback queue 裡面，也因此他會第四個輸出。

### console.log(5)

	3. 在 console 輸出 3

順序 console.log(1) => console.log(3) => console.log(5) => 
setTimeout(() => { console.log(2) }, 0) => 
setTimeout(() => { console.log(4) }, 0)

console 再跑函式的時候 會先照著程式一行一行看下來
而 setTimeout 雖然他設定於第零秒的時候輸出(非同步)
但還是會晚於正常的 console.log

## hw4 done


Call Stack => Web APIs => Call Back Queue => Call Stack