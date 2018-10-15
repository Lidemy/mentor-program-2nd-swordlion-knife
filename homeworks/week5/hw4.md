## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
### varchar
儲存變長數據，必須定義長度，有默認值。 varchar 類型的實際長度是它的值實際長度+1。
### text
儲存可變長度的非 Unicode數據，最大長度是2^31-1個字。 text不能有默認值，儲存或檢索的時候不存在大小寫轉換，如果指定長度的話不會出錯，但指定的長度是不起作用的。假如儲存數據的時候超過指定的長度還是能正常儲存。

#### 比較

經常變化的字段使用 varchar
知道固定長度的用 char
盡量用 varchar
超過255個字的只能用 varchar 或 text
能用 varchar 的地方不用 text

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又會以什麼形式帶去 Server？

### What is cookie ??

很多網站在我們瀏覽之後，會在電腦系統中留下一些小小的檔案，也就是所謂的 Cookie。
當我們再去瀏覽這些網站時，系統便會去讀取這些 Cookie 檔並且會重新儲存一遍。
當我們在瀏覽網站的時候，WEB 伺服器會先送一些資料放在我們的電腦上，Cookie 會把我們在網站上所打的文字或是一些選擇，都紀錄下來。當下次我們再光臨同一個網站，WEB 伺服器會先看看有沒有它上次留下的 Cookie 資料，有的話，就會依據 Cookie 裡的內容來判斷使用者，再送出特定的網頁內容給你。

### set up a cookie

PHP => setcookie(name,value,expire,path,domain,secure)

HTML => Set-Cookie: <cookie-name>=<cookie-value>; Expires=<date>
		Set-Cookie: <cookie-name>=<cookie-value>; Max-Age=<non-zero-digit>
		Set-Cookie: <cookie-name>=<cookie-value>; Domain=<domain-value>
		Set-Cookie: <cookie-name>=<cookie-value>; Path=<path-value>
		Set-Cookie: <cookie-name>=<cookie-value>; Secure


### 瀏覽器會以什麼形式帶去 server

當伺服器收到Request，就傳回一個包含了一或多個Set-Cookie欄的HTTP Response給瀏覽器。 這一欄包含了伺服器想儲存的Cookie資訊。瀏覽器就會將Cookie儲存起來，通常儲存在一個檔案內。 當瀏覽器要求某一個網頁時，瀏覽器會檢查它儲存了的Cookie是否允許被該網頁存取， 如果允許就會在HTTP Request Header加入Cookie。

## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？

如果沒有特別做防範的話，很多向資料庫存取資源的時候。
只要是可以輸入文字的區域，都容易被駭客以其他的語法或是一些特別的方式存取，
進而損失客戶資訊或一些比較重要的情報。
因此將顧客的資訊密碼做加密，或是在向資料庫傳遞資訊時，
使用stmt這個方法，進而做防範。
