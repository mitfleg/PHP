<?php
define('BASE_PATH', realpath(dirname(__FILE__)));

require_once 'vendor/autoload.php';

use Helper\DatabaseConnection;

$db = new DatabaseConnection(BASE_PATH . '/config/database.php');
$conn = $db->connect();

$queries = [
    "CREATE TABLE IF NOT EXISTS books (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        copies INT DEFAULT 0,
        is_written_off TINYINT(1) DEFAULT 0,
        write_off_reason VARCHAR(255) DEFAULT NULL
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",

    "CREATE TABLE IF NOT EXISTS authors (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",

    "CREATE TABLE book_authors (
        id INT AUTO_INCREMENT PRIMARY KEY,
        book_id INT,
        author_id INT,
        UNIQUE KEY (book_id, author_id),
        FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
        FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE CASCADE
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",

    "CREATE TABLE readers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",

    "CREATE TABLE loans (
        id INT AUTO_INCREMENT PRIMARY KEY,
        book_id INT,
        reader_id INT,
        loan_date INT NOT NULL,
        return_date INT,
        FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE SET NULL,
        FOREIGN KEY (reader_id) REFERENCES readers(id) ON DELETE SET NULL
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
];

// Выполняем каждый запрос
foreach ($queries as $query) {
    try {
        $conn->exec($query);
    } catch (PDOException $e) {
        die("Ошибка при создании таблицы: " . $e->getMessage());
    }
}

echo "Таблицы успешно созданы.";
