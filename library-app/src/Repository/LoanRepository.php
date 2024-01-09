<?php

namespace Repository;

use Model\Loan;

class LoanRepository extends BaseRepository
{
    public function __construct() {
        $this->initClass(Loan::class);
        parent::__construct();
    }
}
