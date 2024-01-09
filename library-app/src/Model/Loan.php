<?php

namespace Model;

use Model\BaseModel;

class Loan extends BaseModel {
    public const TABLE = 'loans';

    public int $book_id;
    public int $reader_id;    
    public int $loan_date;    
    public ?int $return_date = null;    
}