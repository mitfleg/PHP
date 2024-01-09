<?php

namespace Model;

use Model\BaseModel;

class Author extends BaseModel {
    public const TABLE = 'authors';

    public string $name;
}