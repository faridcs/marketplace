<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 6/10/18
 * Time: 6:45 PM
 */

namespace App\Exceptions;

class ApiErrorException extends \Exception
{
    private $errorCode;
    private $errorMessage;
    private $httpStatusCode;

    /**
     * ApiErrorException constructor.
     * @param int $errorCode
     * @param string $errorMessage
     * @param int $httpStatusCode
     */
    public function __construct($errorCode, $errorMessage, $httpStatusCode = 400)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->httpStatusCode = $httpStatusCode;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param mixed $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return mixed
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * @param mixed $httpStatusCode
     */
    public function setHttpStatusCode($httpStatusCode)
    {
        $this->httpStatusCode = $httpStatusCode;
    }
}