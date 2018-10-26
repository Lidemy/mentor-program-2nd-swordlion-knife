## 請說明 SQL Injection 的攻擊原理以及防範方法

### SQL Injection

應用程式與資料庫層的安全漏洞

#### 作用原理

1.SQL命令可以查詢、插入、更新、刪除。又用分號字元來區別不同命令。
2.SQL命令對於傳入的字串參數是用單引號字元所包起來
3.SQL命令中，可以夾帶註解（連續2個減號字元 -- 後的文字為註解
4.因此，如果在組合SQL的命令字串時，未針對單引號字元作跳脫處理的話，將導致該字元變數在填入命令字串時，被惡意竄改原本的SQL語法的作用

#### 解決方法

使用stmt來bind所有要輸入進資料庫的字串參數!

$stmt = $conn->prepare("SQL") 後面輸入參數的地方使用? 例如: username = ?

$stmt->bind_param("幾個參數",要引入的參數數值)

$stmt->execute();  最後在這裡執行

#### 例子

某個網站的登入驗證的SQL查詢代碼為

strSQL = "SELECT * FROM users WHERE (name = '" + userName + "') and (pw = '"+ passWord +"');"

惡意填入

userName = "1' OR '1'='1";

與

passWord = "1' OR '1'='1";

時，將導致原本的SQL字串被填為

strSQL = "SELECT * FROM users WHERE (name = '1' OR '1'='1') and (pw = '1' OR '1'='1');"

也就是實際上运行的SQL命令會變成下面這樣的

strSQL = "SELECT * FROM users;"

因此達到無帳號密碼，亦可登入網站。所以SQL隱碼攻擊被俗稱為駭客的填空遊戲。


## 請說明 XSS 的攻擊原理以及防範方法

#### 跨網站指令碼（英語：Cross-site scripting，通常簡稱為：XSS）

XSS攻擊通常指的是通過利用網頁開發時留下的漏洞，通過巧妙的方法注入惡意指令程式碼到網頁，使用戶載入並執行攻擊者惡意製造的網頁程式。這些惡意網頁程式通常是JavaScript，但實際上也可以包括Java，VBScript，ActiveX，Flash或者甚至是普通的HTML。攻擊成功後，攻擊者可能得到更高的權限（如執行一些操作）、私密網頁內容、對談和cookie等各種內容。
也就是如果未經保護的話，能在任何能輸入或提交資料的地方，打上程式碼進行駭客攻擊!

### 檢測方法

* <code>><script>alert(document.cookie)</script></code>
* <code>='><script>alert(document.cookie)</script></code>
* <code>"><script>alert(document.cookie)</script></code>
* <code><script>alert(document.cookie)</script></code>
* <code><script>alert (vulnerable)</script></code>
* <code>%3Cscript%3Ealert('XSS')%3C/script%3E</code>
* <code><script>alert('XSS')</script></code>

### 防範方法 

#### PHP 的 htmlentities() 或是 htmlspecialchars() (這次在留言板用的是這個!)

使用escape跳脫字元
在POST我們後端能放上資料庫的位置加上htmlspecialchars
透過以下程式碼

  htmlspecialchars($str, ENT_QUOTES, 'utf-8')

能讓我們即使將javascript程式碼放入資料庫中，也不會執行
而讓他能直接顯示出完完整整的字元

#### 其他程式的防範方法

Python 的 cgi.escape()
ASP 的 Server.HTMLEncode()
ASP.NET 的 Server.HtmlEncode() 或功能更強的 Microsoft Anti-Cross Site Scripting Library
Java 的 xssprotect (Open Source Library)
Node.js 的 node-validator


## 請說明 CSRF 的攻擊原理以及防範方法

### 跨站請求偽造（英語：Cross-site request forgery)

被稱為 one-click attack 或者 session riding，通常縮寫為 CSRF 或者 XSRF

#### 攻擊細節

跨站請求攻擊，是攻擊者通過一些技術手段欺騙用戶的瀏覽器去存取一個自己曾經認證過的網站並執行一些操作(如發郵件，發訊息，甚至財產操作如轉帳和購買商品）。
由於瀏覽器曾經認證過，所以被存取的網站會認為是真正的用戶操作而去執行。這利用了web中驗證用戶身分的漏洞：
☆簡單的身分驗證只能保證請求發自某個用戶的瀏覽器，卻不能保證請求本身是用戶自願發出的☆

#### 例子

假如一家銀行用以執行轉帳操作的URL位址如下：	<code> http://www.examplebank.com/withdraw?account=AccoutName&amount=1000&for=PayeeName </code>

那麼，一個惡意攻擊者可以在另一個網站上放置如下程式碼： <code><img src="http://www.examplebank.com/withdraw?account=Alice&amount=1000&for=Badman"></img></code>

如果有帳戶名為Alice的用戶存取了惡意站點，而她之前剛存取過銀行不久，登入資訊尚未過期，那麼她就會損失1000資金。

這種惡意的網址可以有很多種形式，藏身於網頁中的許多地方。此外，攻擊者也不需要控制放置惡意網址的網站。
例如他可以將這種位址藏在論壇，部落格等任何用戶生成內容的網站中。
這意味著如果伺服器端沒有合適的防禦措施的話，用戶即使存取熟悉的可信網站也有受攻擊的危險。

☆攻擊者並不能通過CSRF攻擊來直接獲取用戶的帳戶控制權，也不能直接竊取用戶的任何資訊。他們能做到的，是欺騙用戶瀏覽器，讓其以用戶的名義執行操作☆

#### 如何預防

##### 1.檢查Referer欄位

HTTP頭中有一個Referer欄位，這個欄位用以標明請求來源於哪個位址。
在處理敏感資料請求時，通常來說，Referer欄位應和請求的位址位於同一域名下。
以銀行操作為例，Referer欄位位址通常應該是轉帳按鈕所在的網頁位址，應該也位於<code>www.examplebank.com</code>之下。
而如果是CSRF攻擊傳來的請求，Referer欄位會是包含惡意網址的位址，不會位於<code>www.examplebank.com</code>之下，這時候伺服器就能識別出惡意的存取。

這種辦法簡單易行，工作量低，僅需要在關鍵存取處增加一步校驗。但這種辦法也有其局限性，因其完全依賴瀏覽器發送正確的Referer欄位。雖然http協定對此欄位的內容有明確的規定，但並無法保證來訪的瀏覽器的具體實現，亦無法保證瀏覽器沒有安全漏洞影響到此欄位。並且也存在攻擊者攻擊某些瀏覽器，篡改其Referer欄位的可能。

☆server端檢查request.referer裡面的domain是不是使用者本人，但某些瀏覽器不支援或是使用者關閉referer功能☆

##### 2.添加校驗token

由於CSRF的本質在於攻擊者欺騙用戶去存取自己設定的位址，所以如果要求在存取敏感資料請求時，要求用戶瀏覽器提供不儲存在cookie中，並且攻擊者無法偽造的資料作為校驗，那麼攻擊者就無法再執行CSRF攻擊。這種資料通常是表單中的一個資料項。伺服器將其生成並附加在表單中，其內容是一個偽亂數。當客戶端通過表單提交請求時，這個偽亂數也一並提交上去以供校驗。正常的存取時，客戶端瀏覽器能夠正確得到並傳回這個偽亂數，而通過CSRF傳來的欺騙性攻擊中，攻擊者無從事先得知這個偽亂數的值，伺服器端就會因為校驗token的值為空或者錯誤，拒絕這個可疑請求。

☆form 裡面多一個hidden的欄位，裡面填入由server隨機產生的值，存入自己session中，並且每一段不同session的值就該更換一次
使用者submit之後，server比對表單中的 csrf token 跟自己 session 裡存的 csrf token 值是否一樣，可以的話就能有效阻擋駭客
畢竟駭客即使可以偽造使用者身分，也無法拿到表單中的 csrf token 值☆

☆☆我覺得這有點像在網路買東西假如要刷卡的話，銀行都會要你提供信用卡背面後3碼這種感覺☆☆☆☆

## 請舉出三種不同的雜湊函數

1. MD5 PHP可以直接使用md5() 來做到雜湊  但安全性好像也是最差的一個
2. SHA-1 雜湊  也被證明不安全 (在可接受時間內 不同輸入可以得到相同輸出)
3. SHA-256 雜湊函數
4. bcrypt 雜湊函數

### 補充雜湊跟加密的區分

加密需要密鑰，且可以透過解密得到原文。（加密可逆）
雜湊不需密鑰，無法逆向解出原始輸入。（雜湊不可逆）


## 請去查什麼是 Session，以及 Session 跟 Cookie 的差別

Session是瀏覽器內建的機制，可以透過認牌不認人的機制存取資訊
COOKIE因為是存在client端容易被竄改或偷取
Session除了可以存取cookie去對應資料庫的通行證之外
製造出不易被竄改的亂數SESSION
也能比cookie存取更多資訊

## `include`、`require`、`include_once`、`require_once` 的差別

### include
使用在程式的流程敘述中，例如if...else...、while、for 敘述中
語法： include("function.php");

### require
使用在程式檔案一開頭，載入程式時會先讀取REQUIRE引入的檔案
語法： require("function.php");

### include_once require_once 
跟上述功能一樣，差別在於引入檔案前，會先檢查檔案是否已經被引入過了，如果有就不會重複引入。

### require和include不同

require適合用來引入靜態的內容，而include則適合用來引入動態的程式碼。
include在執行時，如果include進來的檔案發生錯誤的話，會顯示警告，不會立刻停止；
而require 則是會顯示錯誤，立刻終止程式，不再往下執行。
include可以用在迴圈；require不行。