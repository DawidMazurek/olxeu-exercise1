<?php

namespace naspersclassifieds\olxeu\app;

class Exception extends \Exception implements \JsonSerializable
{
    private $statusCode;

    public function __construct($statusCode = 500, $message = "", $code = 0, \Exception $previous = null)
    {
        $this->statusCode = $statusCode;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    function jsonSerialize()
    {
        return [
            'error' => [
                'code' => $this->getCode(),
                'message' => $this->getMessage()
            ]
        ];
    }

}