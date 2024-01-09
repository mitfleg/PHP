<?php
namespace Helper;

use PDO;

class DatabaseConnection {
    public function connect() {
        $config = require BASE_PATH.'/config/database.php';

        $dsn = "mysql:host={$config['host']};dbname={$config['db_name']};charset={$config['charset']}";
        try {
            $pdo = new PDO($dsn, $config['username'], $config['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
