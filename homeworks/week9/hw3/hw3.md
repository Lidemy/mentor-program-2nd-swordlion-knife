### console.log(1)

在 console 輸出 1

### setTimeout(() => { console.log(2) }, 0)

在第零秒的時候 輸出 console.log(2) 這個 function

### console.log(3)

在 console 輸出 3

### setTimeout(() => { console.log(4) }, 0)

在第零秒的時候 輸出 console.log(4) 這個 function

### console.log(5)

在 console 輸出 3

順序 console.log(1) => console.log(3) => console.log(5) => 
setTimeout(() => { console.log(2) }, 0) => 
setTimeout(() => { console.log(4) }, 0)

console 再跑函式的時候 會先照著程式一行一行看下來
而 setTimeout 雖然他設定於第零秒的時候輸出
但還是會晚於正常的 console.log

## hw4 done