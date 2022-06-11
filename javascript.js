//ここに追加したいJavaScript、jQueryを記入してください。
//このJavaScriptファイルは、親テーマのJavaScriptファイルのあとに呼び出されます。
//JavaScriptやjQueryで親テーマのjavascript.jsに加えて関数を記入したい時に使用します。
'use strict';

window.addEventListener('DOMContentLoaded', () => {
  var addContents = document.querySelector('.add-contents');
  if (addContents != null) {
    setTimeout(() => {
      var analyzeList = document.querySelectorAll('.analyze-cat');
      var analyzeListLen = analyzeList.length;
      var i = 0;
      for (i; i < analyzeListLen; i++) {
        analyzeList[i].classList.remove('analyze-cat--hide');
      }
    }, 50);

    setTimeout(() => {
      var analyzeData = document.querySelectorAll('.analyze-cat-list a');
      var i = 0;
      for(i; i < analyzeData.length; i++) {
        analyzeData[i].classList.remove('analyze-cat-stop');
      }
    }, 200);
  }
});