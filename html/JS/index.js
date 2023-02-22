let startGreet = window.prompt('こんにちは！お名前を教えてね！');
let userName = document.getElementById('subTitle');
let  welcome = document.createElement('p');
welcome.textContent = ` ${startGreet}さん、がんばれ～`;
userName.appendChild(welcome);  

fetch('postname.php', { // 第1引数に送り先
    method: 'POST', // メソッド指定
    headers: { 'Content-Type': 'application/json' }, // jsonを指定
    body: JSON.stringify(startGreet) // json形式に変換して添付
})
    .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
    .then(res => {
        console.log(res); // やりたい処理
    })
    .catch(error => {
        console.log(error); // エラー表示
    });