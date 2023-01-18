<?php
include_once '../DbController.php';
$db = new DbController();
$postList = $db->getPostsAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問い合わせ履歴</title>
</head>
<body>
    <h1>お問合せ履歴</h1>
    <table border="1">
        <thead>
            <th>タイトル</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>問い合わせ内容</th>
            <th>担当者</th>
            <th>問い合わせ日時</th>
        </thead>
        <tbody>
            <?php foreach($postList as $post): ?>
                <tr>
                    <td><?php FormController::h($post['title']) ?></td>
                    <td><?php FormController::h($post['name']) ?></td>
                    <td><?php FormController::h($post['mailaddress']) ?></td>
                    <td><?php FormController::h($post['content']) ?></td>
                    <td><?php FormController::h($post['full_name']) ?></td>
                    <td><?php FormController::h($post['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>