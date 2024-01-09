<?php

namespace Contracts;

class BookContract extends BaseContract {

    public string $title;
    public int $copies;
    /**
     * @var string[]
     */
    public array $authors;
}
