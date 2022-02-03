### Line Bot 使用
```text


請去 .env 檔 填入這兩個參數
LINE_ACCESS_TOKEN=
LINE_CHANNEL_SECRET=
這兩個東西要先去 lind developer 註冊你的聊天機器人應用 就會拿到

然後去 controller/api LineWebhookController 裡面我有寫註解 參考來做
api/line/webhook 這個 route 是要設定在 line developer 頁面這樣才收得到訊息
api/line/createRichMenu 這個 route 目前會去生產基本的menu 然後套用到所有user 基本上這邊樣式改好觸發一次之後就都會有了

LineWebhookController createRichMenuForUser 這個 function 就是拿來製作特定user 選單的 裡面註解我有解釋怎麼使用了
```
