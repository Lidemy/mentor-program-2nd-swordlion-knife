## 請解釋後端與前端的差異。

-- web前端： 所有能看的見的東西都略分為前端, 例: HTML,CSS 大多是介面設計，或是拿設計師給的草稿做出理想的網頁

-- web後端： 隱藏在背後看不見的皆為後端,包含從資料庫拿資料出來、程式碼的運行與函式等等，例: DOM, JAVASCRIPT,能與使用者產生互動但又比較難察覺的部分?!

## 假設我今天去 Google 首頁搜尋框打上：JavaScript 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。

-- 透過圖形介面也就是GOOGLE搜尋框打出關鍵字

-- 按下ENTER

-- 系統發出request給遠端主機

-- 遠端主機產生回應

-- 開始從資料庫取出資料

-- 找到資料以後回傳response

-- 在使用者的圖形介面產生結果


## 請列舉出 5 個 command line 指令並且說明功用

-- cd  ../ --
更換資料夾

-- clear --
清除畫面

-- git status --
看有什麼更改 或是有沒有沒有commit的檔案

-- git add 檔案 --
新增自己變更的改動

-- git commit -m "名字" --
確認變動

### branch 
-- git branch branch名 --
創造branch 

-- git branch -d branch名 --
刪除branch

-- git branch -v --
觀看現在自己創造幾個branch

-- git checkout branch名 --
到自己創造的branch裡

### push 
-- git push 遠端 自己的branch --
把自己的branch push 到遠端資料庫以進行push request

-- git clone 遠端資料庫網址 --
把遠端資料庫拉到自己的branch裡