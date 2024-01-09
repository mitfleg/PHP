<?php

namespace Model;

use Model\BaseModel;

class Book extends BaseModel {
    public const TABLE = 'books';

    public string $title;
    public int $copies;    
    public bool $is_written_off = false;    
    public ?string $write_off_reason = null;    
}