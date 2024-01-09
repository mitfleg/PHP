<?php

namespace Exception;

class BaseException extends \DomainException {

    /** var array */
    private $_data;
    private $description;

    function __construct($message, string $description = '', array $data = [], \Throwable $previous = null) {
        $this->_data = $data;
        $this->description = $description;
        parent::__construct($message, 0, $previous);
    }

    function getApiErrMessage() {
        return [
            'error_code' => $this->message,
            'error_desc' => $this->description,
            'error_data' => $this->_data
        ];
    }

    public function getData() {
        return $this->_data;
    }
}
