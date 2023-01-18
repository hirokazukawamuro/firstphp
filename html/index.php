<?php

require_once 'DbController.php';

FormController::generateToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問合せ</title>
</head>
<body>
    <h1>お問合せ</h1>
    <form action="thanks.php" method="post">
        <?php if(!empty($_SESSION['messages'])): ?>
            <?php foreach($_SESSION['messages'] as $message ): ?>
                <strong><?php FormController::h($message); ?></strong><br>
            <?php endforeach; ?>
        <?php endif; ?>
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <table>
            <tbody>
                <tr>
                    <th>件名(必須)</th>
                    <td><input type="text" name="title" value=""></td>
                </tr>
                <tr>
                    <th>名前(必須)</th>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <th>メールアドレス(必須)</th>
                    <td><input type="text" name="mailaddress"></td>
                </tr>
                <tr>
                    <th>問い合わせ内容(必須)</th>
                    <td><textarea name="content"></textarea></td>
                </tr>
            </tbody>
        </table>
        <input type="submit" value="送信" name="submit">
    </form>
</body>
</html>
<?php FormController::resetMessage(); ?>
