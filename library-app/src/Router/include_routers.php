<?php

use Router\Router;

$router = new Router();
$router->addRoute('GET',    '/books',                               'Controller\\BookController::getAllBooks');
$router->addRoute('POST',   '/books/add',                           'Controller\\BookController::addBook');
$router->addRoute('POST',   '/books/{book_id:\d}/lend',             'Controller\\BookController::takeBook');
$router->addRoute('PUT',    '/books/{book_id:\d}/write_off_book',   'Controller\\BookController::writeOffBook');

$router->addRoute('POST',   '/reader/add',                          'Controller\\ReaderController::addReader');


$router->dispatch();
