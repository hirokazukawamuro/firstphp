<?php
require_once 'DbController.php';
session_start();
$raw = file_get_contents('php://input'); // POSTされた生のデータを受け取る
$startGreet = json_decode($raw); // json形式をphp変数に変換
$res = $startGreet; // やりたい処理
echo json_encode($res);

//json変換して受け取ったデータをDBにINSERTする
// クエリ
$sql = "INSERT INTO username (userName) VALUES ('$res')";
//  クエリを実行
$stmt = $dbn->query($sql);
if (!$stmt){
  error_log($dbn->error);
  exit;
}

$_SESSION['nameid'] = $dbn -> lastInsertId();

?>