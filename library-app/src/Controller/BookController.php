<?php

namespace Controller;

use Contracts\BookContract;
use Contracts\TakeBookContract;
use Contracts\WriteOffBookContract;
use Http\Request;
use Http\Response;
use Service\AuthorService;
use Service\BookService;
use Service\LoanService;

class BookController extends BaseController
{

    public static function getAllBooks(Request $req, Response $resp): void
    {
        $manager_book = new BookService();
        $books = $manager_book->getAllBooks();
        $resp->success($books);
    }

    public static function addBook(Request $req, Response $resp): void
    {
        /**
         * @var BookContract
         */
        $reqData = $req->validateAndGet(new BookContract());
        $manager_book = new BookService();
        $manager_author = new AuthorService();
        $author_ids = $manager_author->saveAuthor($reqData->authors);
        $book_id = $manager_book->saveBook($reqData->title, $reqData->copies, $author_ids);
        $resp->success(['id' => $book_id]);
    }

    public static function takeBook(Request $req, Response $resp): void
    {
        /**
         * @var TakeBookContract
         */
        $reqData = $req->validateAndGet(new TakeBookContract());
        $book_id = $req->getUriParams('book_id');
        $manager = new LoanService();
        $loan_id = $manager->takeBook($book_id, $reqData->reader_id);
        $resp->success(['id' => $loan_id]);
    }

    public static function writeOffBook(Request $req, Response $resp): void
    {
        /**
         * @var WriteOffBookContract
         */
        $reqData = $req->validateAndGet(new WriteOffBookContract());
        $book_id = $req->getUriParams('book_id');
        $manager = new BookService();
        $manager->writeOffBook($book_id, $reqData->write_off_reason);
        $resp->success();
    }
}
