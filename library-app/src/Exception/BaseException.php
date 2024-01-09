<?php

namespace Exception;

class BaseException extends \DomainException
{

    private $_data;
    private $description;

    function __construct($message, int $code = 0, string $description = '', array $data = [], \Throwable $previous = null)
    {
        $this->_data = $data;
        $this->description = $description;
        parent::__construct($message, $code, $previous);
    }

    function getApiErrMessage()
    {
        return [
            'result' => 'error',
            'data' => [
                'error_message' => $this->message,
                'error_desc' => $this->description,
                'error_data' => $this->_data
            ]
        ];
    }

    public function getData()
    {
        return $this->_data;
    }
}
