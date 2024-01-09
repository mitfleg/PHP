<?php

namespace Repository;

use Model\Author;

class AuthorRepository extends BaseRepository{
    public function __construct() {
        $this->initClass(Author::class);
        parent::__construct();
    }
}