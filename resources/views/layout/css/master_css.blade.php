<style>
    html, body {
  height: 100%; /*外層高度100%*/
  margin: 0;
}
.wrapper {
  min-height: 100%; /*外層高度100%*/
  margin-bottom: -100px; /*隨footer高度需做調整*/
}
.content{
    padding-top: 50px; /*避免文字超出瀏覽器時，內容區塊不會和footer打架*/
  padding-bottom: 50px; /*避免文字超出瀏覽器時，內容區塊不會和footer打架*/
}
.footer{
  height: 100px; /*設定footer本身高度*/
  background-color: white;
}
</style>