<?php

namespace Http;

use Contracts\BaseContract;

class Request
{
    public $query;
    public $request;
    public $files;
    public $server;
    public $headers;
    public $uriParams;

    public function __construct()
    {
        $this->query = $_GET;
        $this->files = $_FILES;
        $this->server = $_SERVER;
        $this->headers = $this->getAllHeaders();

        $this->handleRequest();
    }

    private function handleRequest()
    {
        if ($this->server['REQUEST_METHOD'] === 'POST' || $this->server['REQUEST_METHOD'] === 'PUT') {
            if (strpos($this->server['CONTENT_TYPE'], 'application/json') !== false) {
                $jsonData = json_decode(file_get_contents('php://input'), true);
                $this->request = is_array($jsonData) ? $jsonData : [];
            } elseif ($this->server['REQUEST_METHOD'] === 'POST') {
                $this->request = $_POST;
            }
        }
    }

    private function getAllHeaders(): array
    {
        if (function_exists('getallheaders')) {
            return getallheaders();
        } else {
            $headers = array();
            foreach ($_SERVER as $name => $value) {
                if (substr($name, 0, 5) == 'HTTP_') {
                    $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                }
            }
            return $headers;
        }
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function validateAndGet(BaseContract $contract): BaseContract
    {
        return $contract->validate($this->request);
    }

    public function setUriParams(array $params)
    {
        $this->uriParams = $params;
    }

    public function getUriParams($key, $default = null)
    {
        return $this->uriParams[$key] ?? $default;
    }
}
