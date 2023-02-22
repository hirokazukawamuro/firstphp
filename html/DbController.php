<?php
try{
 
 $DB_USERNAME = 'root';
 $DB_PASSWORD = '';
 $DB_OPTION = 'charset=utf8';
 $PDO_DSN = "mysql:host=localhost;dbname=php_onepiece"; $DB_OPTION;
 $dbn = new PDO($PDO_DSN, $DB_USERNAME, $DB_PASSWORD,
 [   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
 ]);
 } catch(PDOException $e){
    print("Connection failed:".$e->getMessage());  
    echo 'DB接続失敗';
}
?>