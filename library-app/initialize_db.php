<?php
require_once 'vendor/autoload.php';

use Helper\DatabaseConnection;

$db = new DatabaseConnection();
$conn = $db->connect();

$queries = [
    "CREATE TABLE IF NOT EXISTS books (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        copies INT DEFAULT 1
    )",
    "CREATE TABLE IF NOT EXISTS authors (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )",
    "CREATE TABLE book_authors (
        book_id INT,
        author_id INT,
        PRIMARY KEY (book_id, author_id),
        FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
        FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE CASCADE
    );",
    "CREATE TABLE readers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    );",
    "CREATE TABLE loans (
        id INT AUTO_INCREMENT PRIMARY KEY,
        book_id INT,
        reader_id INT,
        loan_date DATE NOT NULL,
        return_date DATE,
        FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE SET NULL,
        FOREIGN KEY (reader_id) REFERENCES readers(id) ON DELETE SET NULL
    );"
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
