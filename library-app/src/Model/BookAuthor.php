<?php

namespace Model;

use Model\BaseModel;

class BookAuthor extends BaseModel {
    public const TABLE = 'book_authors';

    public int $book_id;
    public int $author_id;    
}