<?php

namespace Helper;

use PDO;

class DatabaseConnection {
    private $configPath;

    public function __construct(string $configPath) {
        $this->configPath = $configPath;
    }

    public function connect() {
        $config = require $this->configPath;

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
