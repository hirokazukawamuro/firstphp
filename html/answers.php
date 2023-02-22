<?php
require_once 'DbController.php';
?>
<?php
$stmt = $dbn->query("select * from 	show_answers");//SQL文格納と実行
$username = $stmt->fetchAll(PDO::FETCH_ASSOC);//SQL文の結果取り出し・配列に入れて操作
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../html/CSS/reset.css">
  <link rel="stylesheet" href="../html/CSS/index.css">
  <link rel="stylesheet" href="../html/CSS/answers.css">
  <title>解答・解説</title>
</head>
<body>
  <table>
    <tr>
      <th>問題番号</th>
      <th>解答</th>
      <th>解説</th>
    </tr>
    <?php foreach($username as $column): ?>
    <tr>
    <td><?php echo $column['number'] ?></td>
    <td><?php echo $column['answer'] ?></td>
    <td><?php echo $column['commentary'] ?></td>  
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>