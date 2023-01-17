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
    public static function h($text)
    {
        if(!is_null($text)) echo htmlspecialchars($text);
    }
}