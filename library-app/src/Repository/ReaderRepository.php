<?php

namespace Repository;

use Model\Reader;

class ReaderRepository extends BaseRepository
{
    public function __construct() {
        $this->initClass(Reader::class);
        parent::__construct();
    }
}
