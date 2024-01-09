<?php

namespace Service;

use Model\Book;
use Model\BookAuthor;
use Repository\BookRepository;

class BookService
{
    private BookRepository $repository_book;

    public function __construct()
    {
        $this->repository_book = new BookRepository();
    }

    public function getBookById(int $book_id): Book
    {
        return $this->repository_book->getById($book_id);
    }

    public function persist(Book $book): Book
    {
        return $this->repository_book->persist($book);
    }

    public function saveBook(string $title, int $copies, array $author_ids): int
    {
        $book = new Book(
            [
                'title' => $title,
                'copies' => $copies,
            ]
        );
        $this->repository_book->persist($book);

        foreach ($author_ids as $author_id) {
            $book_author = new BookAuthor(
                [
                    'book_id' => $book->id,
                    'author_id' => $author_id,
                ]
            );
            $this->repository_book->persist($book_author);
        }

        return $book->id;
    }

    public function getAllBooks(): array
    {
        return $this->repository_book->getAllBooks();
    }

    public function writeOffBook(int $book_id, string $write_off_reason): void
    {
        /**
         * @var Book
         */
        $book = $this->repository_book->getById($book_id);
        $book->is_written_off = true;
        $book->write_off_reason = $write_off_reason;
        $this->repository_book->persist($book);
    }
}
