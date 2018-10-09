## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
div 區塊 display內設為block
p 段落文字
h 標題 類似的有 i 表示斜體 em 表示強調的文本 strong 表示重要的文本 mark 標示突出的文本
a 超連結 用法為加上 href= "網站連結"
span 類似div 但 div 會占用一行，而 span 不會
img 超連結顯示圖片
iframe 元素會創建包含另外一個文檔的內框架

## 請問什麼是盒模型（box modal）

盒模型是指HTML程式在包裝元素的時候
會從外而內建立一個像盒子的模型

從外至內分別是	margin 外邊距
				border 外框
				padding 內邊距
   	最後才是		content 內容.

### 盒模型在寬度上還有一個小要點 Box-sizing

#### 預設為 content-box

border 跟 margin 不包含在 width 裡面
例: width: 100px 會再加上 border 和 margin 成為實際上的寬度

#### 修改為 border-box

border 跟 margin 會包含在 width 裡面
例: width: 100px 就是實際上的寬度

## 請問 display: inline, block 跟 inline-block 的差別是什麼？

### block 
預設的 display
#### div 、 p 、 h1 、 h2 
這幾種 HTML 元素預設的 display 屬性是 block 
在 block 中的元素，不管前面後面是什麼，碰到 display : block 就是會換行，
而 display : block 元素的寬度預設會撐到最大。
#### margin 、padding 、 width 、 height 、 background-image 
這些設定可以進行調整。
#### 在元素中加上 margin : 0 auto
可以將區域內元素水平置中

### inline 

#### a 、 span 、 b 、 i 、 img 、 iframe
這幾個 HTML 元素預設的 display 屬性是 inline 
兩個 display : inline 的元素會在同一行，不會進行換行。

#### inline 可調整的 HTML 元素
margin-left 、 margin-right 、 padding-left 、 padding-right 
#### inline 不可調整的 HTML 元素
margin-top 、 margin-bottom 、 padding-top 、 padding-bottom 、 width 、 height 、 background-image 。

#### display : inline 元素水平置中
在此元素的父元素加上 text-align : center 

### inline-block

在區塊外面是 inline
區塊裡面是 block 

#### 碰到 display : inline-block 
元素不會換行，但是又可以設定 padding-top 、 padding-bottom 、 width 、 height 、 background-image 。

用 CSS 讓連結用圖片顯示就是 inline-block 常見的應用。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

static 不會被特別定位，照著瀏覽器預設自動排版在頁面上

relative 可以透過不同元素設定 relative 屬性來達到相對位置，也可以設定上下左右使元素相對地調整原本該出現的所在位置

absolute 跟 fixed 屬性類似，但 absolute 屬性的元素會相對他上層 potiotion 不是 static 的容器移動，如果沒有就會相對於 body 元素最左上角的絕對位置

fixed 設定 fixed 屬性的元素會相對於瀏覽器視窗來定位，即使頁面捲動 fixed 屬性的元素還是會固定在相同的位置