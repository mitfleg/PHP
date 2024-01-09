<?php

namespace Repository;

use Model\Book;
use PDO;

class BookRepository extends BaseRepository
{
    public function __construct()
    {
        $this->initClass(Book::class);
        parent::__construct();
    }

    public function getAllBooks(): array
    {
        $sql = "
            SELECT 
                `b`.`id` as `book_id`,
                `b`.`title` as `book_title`,
                `b`.`copies` as `book_copies`,
                `b`.`is_written_off` as `book_is_written_off`,
                `b`.`write_off_reason` as `book_write_off_reason`,
                `b`.`copies` as `book_copies`,
                `a`.`name` as `authors`
            FROM `books` as `b`
            INNER JOIN `book_authors` as `ba` ON (`ba`.`book_id` = `b`.`id`)
            INNER JOIN `authors` as `a` ON (`a`.`id` = `ba`.`author_id`)
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        foreach ($rows as $row) {
            $book_id = $row['book_id'];
            $book_title = $row['book_title'];
            $book_is_written_off = $row['book_is_written_off'];
            $book_write_off_reason = $row['book_write_off_reason'];
            $book_copies = $row['book_copies'];
            $author = $row['authors'];

            if (!isset($books[$book_id])) {
                $books[$book_id] = [
                    'id' => $book_id,
                    'title' => $book_title,
                    'copies' => $book_copies,
                    'is_written_off' => $book_is_written_off == 1 ? true : false,
                    'write_off_reason' => $book_write_off_reason,
                    'authors' => []
                ];
            }

            $books[$book_id]['authors'][] = $author;
        }

        $books = array_values($books);
        return $books;
    }
}
