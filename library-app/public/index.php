<?php
define('BASE_PATH', realpath(dirname(__FILE__).'/..'));
require_once BASE_PATH . '/vendor/autoload.php';

use Helper\DatabaseConnection;
use Repository\BookRepository;

$db = new DatabaseConnection();
$repo = new BookRepository($db);
$repo->test();