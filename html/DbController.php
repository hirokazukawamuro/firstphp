<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


class DbController {
    private $dbh;
    public function __construct()
    {
        $dsn = "mysql:dbname={$_ENV['DB_DATABASE']};host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};charset=utf8";
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];
        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch(PDOException $e) {
            print("Connection failed:".$e->getMessage());
            die();
        }
    }

    public function getPostsAll(): array
    {
        $sql = <<< EOL
SELECT
    title,
    name,
    mailaddress,
    content,
    COALESCE(CONCAT(s.last_name, ' ', s.first_name),'未割当') as full_name,
    c.created_at
FROM contacts AS c
LEFT OUTER JOIN staffs AS s
ON c.staff_id = s.id
EOL;
        return $this->dbh
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertContact($post)
    {
        $sql =  <<<EOL
INSERT INTO contacts(title,name,mailaddress,content)
VALUES (?,?,?,?)
EOL;
        $stmt = $this->dbh->prepare($sql);
        return $stmt->execute([
            $post['title'],
            $post['name'],
            $post['mailaddress'],
            $post['content'],
        ]);
    }
}

class FormController
{
    public static function post()
    {
        session_start();
        if(!isset($_POST['submit'])){
            header('Location: /');
            return;
        }
        if(!isset($_SESSION['token'])){
            header('Location: /');
            return;
        }
        if(!isset($_POST['token'])){
            header('Location: /');
            return;
        }
        if($_POST['token'] != $_SESSION['token']){
            $_SESSION['messages']['token_error'] = '不正な投稿です！';
            header('Location: /');
            return;
        }
        if(self::isValidateError($_POST)){
            header('Location: /');
            return;
        }
        $db = new DbController();
        if(!$db->insertContact($_POST)){
            $_SESSION['messages']['insert_error'] = '投稿に失敗しました！';
            header('Location: /');
        }
        $_POST = null;
        session_destroy();
    }
    public static function generateToken()
    {
        session_start();
        $str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPUQRSTUVWXYZ';
        $str_r = substr(str_shuffle($str), 0, 10);
        $_SESSION['token'] = $str_r;
    }
    public static function resetMessage()
    {
        $_SESSION['messages'] = null;
    }
    public static function isValidateError($post)
    {
        $has_error = false;
        if(empty($post['title'])){
            $_SESSION['messages']['title_error'] = '件名は必須項目です！';
            $has_error = true;
        }
        if(empty($post['name'])){
            $_SESSION['messages']['name_error'] = '名前は必須項目です！';
            $has_error = true;
        }
        if(empty($post['mailaddress'])){
            $_SESSION['messages']['mailaddress_error'] = 'メールアドレスは必須項目です！';
            $has_error = true;
        }
        $regex = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
        if(!preg_match($regex, $post['mailaddress'])){
            $_SESSION['messages']['mailaddress_error'] = '正しいメールアドレス形式にしてください！';
            $has_error = true;
        }
        if(empty($post['content'])){
            $_SESSION['messages']['content_error'] = '問い合わせ内容は必須項目です！';
            $has_error = true;
        }
        return $has_error;
    }
    public static function h($text)
    {
        if(!is_null($text)) echo htmlspecialchars($text);
    }
}