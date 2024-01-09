<?php
define('BASE_PATH', realpath(dirname(__FILE__).'/..'));
define('DB_PATH', BASE_PATH . '/config/database.php');
require_once BASE_PATH . '/vendor/autoload.php';

use Exception\BaseException;

try {
    require_once BASE_PATH . '/src/Router/include_routers.php';
} catch (BaseException $e) {
    $code = $e->getCode() ?: 500;
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($code);
    echo json_encode($e->getApiErrMessage(), JSON_UNESCAPED_UNICODE);
}



