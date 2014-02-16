<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/01/14
 * Time: 14:20
 */

namespace Exception;


class StatusIdException extends \RuntimeException
{
    private $statusCode;

    public function __construct($statusCode, $message = null, \Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);

        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
