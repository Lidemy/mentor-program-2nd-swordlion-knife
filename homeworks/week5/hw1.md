資料庫名稱：comments

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 留言 id     |
| major  | integer | 判斷是否為主留言  |
| user_id | integer | 留言人 |
| content | text | 留言內容 |
| created_at | time | 留言時間 |

資料庫名稱：comments 

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 留言 id     |
| nickname  | text | 暱稱  |
| account | varchar(16) | 會員帳號 |
| password | varchar(16) | 會員密碼 |