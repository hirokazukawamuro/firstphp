<?php
include_once '../DbController.php';
$ken = new DbController();
$postList = $ken->getPostsAll();
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
    <table>
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
                    <td><?php DbController::h($post['title']) ?></td>
                    <td><?php DbController::h($post['name']) ?></td>
                    <td><?php DbController::h($post['mailaddress']) ?></td>
                    <td><?php DbController::h($post['content']) ?></td>
                    <td><?php DbController::h($post['full_name']) ?></td>
                    <td><?php DbController::h($post['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>