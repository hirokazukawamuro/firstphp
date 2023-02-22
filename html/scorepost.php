<?php
session_start();

require_once 'DbController.php';
$raw = file_get_contents('php://input'); // POSTされた生のデータを受け取る
$score = json_decode($raw); // json形式をphp変数に変換
$res = $score; // やりたい処理
echo json_encode($res);
//json変換して受け取ったデータをDBにINSERTする
// クエリ
$sql = "INSERT INTO scorelist (score,name_id) VALUES ('{$res}','{$_SESSION['nameid']}')";
//  クエリを実行
$stmt = $dbn->query($sql);
if (!$stmt){
  error_log($dbn->error);
  exit;
}
?>