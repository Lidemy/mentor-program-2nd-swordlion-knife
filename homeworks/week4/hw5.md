## 1.什麼是 DOM？
之前寫過一次但現在有點忘記，重新複習查怎麼寫的時候以為是javascript的一部分。
畢竟他大部分都是使用javascript來存取DOM，但其實他也可以被其他語言存取。

### Document Object Model 文件物件模型

DOM 提供了一個樹的結構化表示法，讓文件擁有屬性與函式的節點與物件組成的結構化表示。
節點用來處理附加事件，或觸發事件來說非常方便!!!

## 2.什麼是 Ajax？

傳統的表單 form 在向伺服器傳出 request 以及回收 response 的時候常會在不知不覺中消耗掉許多頻寬，
也容易拖慢整體的速度。

### Asynchronous JavaScript and XML 非同步的JavaScript與XML技術

但自從 AJAX 出現後可以只向伺服器傳送並取回必須的資料，
最大的特點就是能在不更新整個頁面的前提下維護資料，
接下來要做的留言板就是其中一個，可以直接刷新留言而不用更新整個網頁，
非常方便!!

## 3.HTTP method 有哪幾個？有什麼不一樣？

* GET : 從伺服器端拿資料
* POST : 從客戶端送資料給伺服器
* PATCH : 附加新的資料在已經存在的資料後面。（資料必須已經存在，patch 會擴充這項資料）
* PUT : 新增一項資料，如果存在就覆蓋過去。（還是只有一筆資料）
* DELETE : 刪除資料
* OPTION : 看伺服器支援的 method
* HEAD : 從伺服器端拿資料 但 HEAD 的 RESPONSE 沒有 BODY
* CONNECT : 開啟客戶端與所請求資源之間的雙向通到，可用來建立 TUNNEL


## 4.`GET` 跟 `POST` 有哪些區別，可以試著舉幾個例子嗎？

#### 留言板 
假如我們現在有一個可以留言的留言板，我們通常會使用GET來取得現在已經存在的留言，
而要新增新的留言時，我們會 POST 新的留言到現在的留言板。

#### 餐廳
假如我們要點餐，我們必須先用 GET 取得菜單資訊，接下來再將想要點的餐 POST 到服務生那裏去。

### GET

1.網址會帶有 HTML Form 表單的參數與資料
2.透過 URL 帶資料，所以有長度限制。
3.表單參數和填寫內容可以在URL看到。

### POST

1.資料傳遞的時候，網址不會改變。
2.不透過 URL 帶參數，不受限URL長度限制。
3.透過 HTTP Request 方式傳遞，參數和填寫內容不會顯示在URL。

#### 一般的表單可以用 GET 直接傳遞，而需要保密的資料必須用 POST 來處理，像是會員登入的帳號密碼。

## 5.什麼是 RESTful API？

#### Representational State Transfer，簡稱REST
它是一種網路架構風格，不是一種標準。

以 API 而言，假設我們正在撰寫一組待辦事項的 API，
可能會有以下方式來作為 API 的 interface:

獲取使用者資料 /getAllUsers
獲取使用者資料 /getUser/1
新增使用者資料 /createUser
更新使用者資料 /updateUser/1
刪除使用者資料 /deleteUser/1

若是以 REST 風格來開發 RESTful API 的話:

獲取使用者資料 /GET /users
獲取使用者資料 /GET /user/1
新增使用者資料 /POST /user
更新使用者資料 /PUT /user/1
刪除使用者資料 /DELETE /user/1

兩者差異是在於 RESTful API 充分地使用了 HTTP protocol (GET/POST/PUT/DELETE)，達到:

以直觀簡潔的資源 URI
並且善用 HTTP Verb
達到對資源的操作
p.s. 因為 REST 並非是一種標準，因此有時候也不一定非得要照著 REST 來做，
只是在資源的操作面上，可以設計成這類的風格，以達到簡潔易懂，並且可重用。

## 6.JSON 是什麼？

#### JavaScript Object Notation

輕量級的資料交換語言，該語言以易於讓人閱讀的文字為基礎，用來傳輸由屬性值或者序列性的值組成的資料物件。儘管JSON是JavaScript的一個子集，但JSON是獨立於語言的文字格式，並且採用了類似於C語言家族的一些習慣。

#### JSON用於描述資料結構，有兩種結構存在：

物件（object）：一個物件包含一系列非排序的名稱/值對 (pair)，一個物件以 { 開始，並以 } 結束。每個名稱/值之間使用:分割。
陣列 (array)：一個陣列是一個值(value)的集合，一個陣列以 [ 開始，並以 ] 結束。陣列成員之間使用,分割。

例如: 
{ 
	name : value ,
	id : value
}

## 7.JSONP 是什麼？

#### JSON with Padding 

是資料格式JSON的一種使用模式

#### 同源策略

一般來說位於 server1.example.com 的網頁無法與 server2.example.com 的伺服器溝通，而 HTML 的 script 元素是一個例外。利用 script 元素的這個開放策略，網頁可以得到從其他來源動態產生的 JSON 資料，而這種使用模式就是所謂的  JSONP 。用 JSONP 抓到的資料並不是 JSON ，而是任意的 JavaScript ，用 JavaScript 直譯器執行而不是用 JSON 解析器解析。

#### 一份JSON檔案並不是一個JavaScript程式
為了讓瀏覽器可以在 script 元素執行，從 src 裡 URL 回傳的必須是可執行的 JavaScript 。在 JSONP 的使用模式裡，該 URL 回傳的是由函式呼叫包起來的動態生成 JSON，這就是 JSONP 的「填充（padding）」或是「前輟（prefix）」的由來。

寫法: script type="text/javascript" src="http://server2.example.com/RetrieveUser?UserId=1823&jsonp=parseResponse"> /script 
伺服器會在傳給瀏覽器前將JSON資料填充到回呼函式（parseResponse）中。瀏覽器得到的回應已不是單純的資料敘述而是一個指令碼

## 8.要如何存取跨網域的 API？

用 JSONP script 可以跨網域的特性，在 HTML 裡引用 API URL 到 script 裡，然後在定義 callback
function 的參數，最後再在 javascript 檔案用 call back function 叫出 JSONP 的資料。