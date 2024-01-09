<?php

namespace Model;

use Model\BaseModel;

class Reader extends BaseModel {
    public const TABLE = 'readers';

    public string $name;
}