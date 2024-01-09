<?php

namespace Service;

use Model\Reader;
use Repository\ReaderRepository;

class ReaderService
{
    private ReaderRepository $repository_reader;

    public function __construct()
    {
        $this->repository_reader = new ReaderRepository();
    }

    public function addReader(string $name) : int {
        $reader = new Reader(
            [
                'name' => $name
            ]
        );
        $this->repository_reader->persist($reader);
        return $reader->id;
    }

}
