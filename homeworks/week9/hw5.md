## CSS 預處理器是什麼？我們可以不用它嗎？
	的確可以不使用他，但CSS有著結構很難有組織、難維護的缺點，如果寫CSS也能像一般程式語言一樣，
	具有變數、數學運算、條件式、迴圈、函式庫等等就有很大幫助，這也是CSS預處理器產生的原因。

## 請舉出任何一個跟 HTTP Cache 有關的 Header 並說明其作用。
	Expires [Expires: Wed, 21 Oct 2017 07:28:00 GMT] cache　到期的時間~

	Cache-Control 與 max-age http1.1版 Cache-Control:max-age=31536000 cache　存活秒數

	max-age　>　Expires

	Last-Modified與If-Modified-Since
	Last-Modified: 2017-01-01 13:00:00  最後更新時間
	If-Modified-Since: 2017-01-01 13:00:00 從這個時間過後有沒有更新

	有更新的話會更新  沒更新的話就用舊的

	Etag跟If-None-Match
	Server 在回傳 Response 的時候帶上Etag表示這個檔案獨有的 hash
	快取過期後瀏覽器發送If-None-Match詢問 Server 是否有新的資料

	Cache-Control: no-store  不需要任何快取

## Stack 跟 Queue 的差別是什麼？

	Stack = 先進後出  first in last out 最晚進來的元素會先被拿走

	Queue = 先進先出  first in first out 最先進來的元素會最先出去

## 請去查詢資料並解釋 CSS Selector 的權重是如何計算的（不要複製貼上，請自己思考過一遍再自己寫出來）

### 基本的權重大小

	!important > inline style > ID > Class > Element > *

	* 權重是最低層級的，佔有的比重是 0,0,0,0

	再來是 element ，也就是 div p 這類的標籤，佔有的比重是0,0,0,1 

	接下來是 Class ，也就是在 CSS 樣式表中有.什麼什麼屬性的，佔有的比重是0,0,1,0

	接下來是 ID ，在 CSS 樣式表中有#什麼什麼的，佔有的比重是0,1,0,0

	接下來是 inline style ，寫在 HTML 檔案裡的 style CSS樣式，除了 !important 這個無敵的存在之外佔有最高的權重，比重是1,0,0,0

	!important 是有點 BUG 的存在，如果使用太多好像也不太好，因為要壓過 !important 的唯有 !important! 佔有的比重是無限大><

	這邊在網路上看到一些加起來算的還看不太懂，晚點補上!!