<?php

namespace YoastSEO_Vendor\GuzzleHttp\Exception;

<<<<<<< HEAD
use YoastSEO_Vendor\Psr\Http\Client\ClientExceptionInterface;
interface GuzzleException extends \YoastSEO_Vendor\Psr\Http\Client\ClientExceptionInterface
{
=======
use Throwable;
if (\interface_exists(\Throwable::class)) {
    interface GuzzleException extends \Throwable
    {
    }
} else {
    /**
     * @method string getMessage()
     * @method \Throwable|null getPrevious()
     * @method mixed getCode()
     * @method string getFile()
     * @method int getLine()
     * @method array getTrace()
     * @method string getTraceAsString()
     */
    interface GuzzleException
    {
    }
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
}
