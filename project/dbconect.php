<?php
// local環境の設定
$dsn = 'mysql:host=127.0.0.1;dbname=order_system;charset=utf8';
$username = 'root';
$password = ''; 
    try {
        $pdo = new PDO($dsn,$username,$password,[

        ]);

    
    } catch (PDOException $e) {
        $message = 'DB接続エラー！: ' . $e->getMessage();
        }

?>

