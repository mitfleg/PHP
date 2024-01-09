<?php

namespace Service;

use Model\Author;
use Repository\AuthorRepository;

class AuthorService
{
    private AuthorRepository $repository_author;

    public function __construct() {
        $this->repository_author = new AuthorRepository();
    }

    public function saveAuthor(array $authors) : array {
        $author_ids = [];
        foreach($authors as $author_name){
            $author = new Author(
                [
                    'name' => $author_name
                ]
            );
            $this->repository_author->persist($author);
            $author_ids[] = $author->id;
        }
        return $author_ids;
    }
}
