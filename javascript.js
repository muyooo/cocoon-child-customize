//ここに追加したいJavaScript、jQueryを記入してください。
//このJavaScriptファイルは、親テーマのJavaScriptファイルのあとに呼び出されます。
//JavaScriptやjQueryで親テーマのjavascript.jsに加えて関数を記入したい時に使用します。
'use strict';

window.addEventListener('load', () => {
  setTimeout(() => {
    const analyzeList = document.querySelector('.analyze-cat');
    analyzeList.classList.remove('analyze-cat--hide');
  }, 100);
  
  setTimeout(() => {
    const analyzeData = document.querySelectorAll('.analyze-cat-list a');
    let i = 0;
    for(i; i < analyzeData.length; i++) {
      analyzeData[i].classList.remove('analyze-cat-stop');
    }
  }, 200);
});