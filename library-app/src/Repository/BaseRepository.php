<?php

namespace Repository;

use Helper\DatabaseConnection;

class BaseRepository {
    private $db;

    public function __construct(DatabaseConnection $db_connection)
    {
        $this->db = $db_connection->connect();
    }
}