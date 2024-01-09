<?php

namespace Service;

use Exception\RepositoryException;
use Model\Loan;
use Repository\LoanRepository;

class LoanService
{
    private LoanRepository $repository_loan;
    private BookService $book_service;

    public function __construct()
    {
        $this->repository_loan = new LoanRepository();
        $this->book_service = new BookService();
    }

    public function takeBook(int $book_id, int $reader_id): int
    {
        $book = $this->book_service->getBookById($book_id);

        if ($book->copies == 0) {
            throw new RepositoryException('Нет свободных книг', 400);
        }

        $loan = new Loan(
            [
                'book_id' => $book_id,
                'reader_id' => $reader_id,
                'loan_date' => time(),
            ]
        );
        $this->repository_loan->persist($loan);
        $book->copies -= 1;
        $this->book_service->persist($book);
        return $loan->id;
    }
}
