// クイズの選択肢と答え
// クイズの選択肢と答え
const quiz = [
  {
    img: '../html/IMG/robincyuan.png',
    answers: [
      'モンキー・D・ルフィ','ロロノア・ゾロ','ニコ・ロビン','サンジ'
    ],
    correct:'ニコ・ロビン'
  },
  {
    img: '../html/IMG/oimo.jpg',
    answers: [
      'キャプテン・クロ','フォクシー','ヨコヅナ','オイモ'
    ],
    correct:'オイモ'
  },
  {
    img: '../html/IMG/cyesu.jpg',
    answers: [
      'トラファルガー・ロー','ボア・ハンコック','ハモンド','チェス'
    ],
    correct:'チェス'
  },
  {
    img: '../html/IMG/kurokkasu.jpg',
    answers: [
      'ブルック','フルボディ','クロッカス','エネル'
    ],
    correct:'クロッカス'
  },
];

const quizLength = quiz.length;
const $btns = document.getElementsByClassName('btn');
let quizIndex = 0;
let score = 0;
let num = 1;

//クイズの問題
const setupQuiz = () =>{
  for (let i = 0;i <$btns.length;i++){
    $btns[i].textContent = quiz[quizIndex].answers[i];
  }
  document.getElementById('target').textContent =`第 ${num} 問`;
  document.getElementById('img_change').src=quiz[quizIndex].img;
  num++;
}

setupQuiz();

for(const btn of $btns) {
  btn.addEventListener('click',(e) =>{
    clickHandler(e);
  });
}

//ボタンを押したら正誤判定
const clickHandler = (e) => {
  if(quiz[quizIndex].correct === e.target.textContent){
    window.alert('正解！');
    score++;
  }
  else {
    window.alert('不正解！');
  }
  quizIndex++;
  if(quizIndex < quizLength){
    //問題数がまだあればこちらを実行
    setupQuiz();
  } else {
      //問題数がもうなければこちらを実行
      window.alert('終了！');
      const $main = document.getElementById('main');
      const h1 = document.createElement('h1');
      h1.innerHTML = 'あなたのスコアは、'+ score + '/' + quizLength + '点です！';
      $main.appendChild(h1);
      document.getElementById('img_change').src='../html/IMG/otukare.png';
      document.getElementById('target').textContent ='間違えたら海賊王にはなれませんねぇ。。。';
      document.getElementById('question').textContent =' ';
      const aTag = document.createElement('a');
      aTag.href = "../html/answers.php";
      aTag.innerText = "解答・解説はこちら";
      $main.appendChild(aTag);
      
      fetch('scorepost.php', { // 第1引数に送り先
        method: 'POST', // メソッド指定
        headers: { 'Content-Type': 'application/json' }, // jsonを指定
        body: JSON.stringify(score) // json形式に変換して添付(ここまででPHPにデータは送り済み)
      })
        .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
        .then(res => {
            console.log(res); // やりたい処理
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
    }

  
}






