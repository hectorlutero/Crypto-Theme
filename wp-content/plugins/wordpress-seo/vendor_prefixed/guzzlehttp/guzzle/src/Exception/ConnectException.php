<?php

namespace YoastSEO_Vendor\GuzzleHttp\Exception;

<<<<<<< HEAD
use YoastSEO_Vendor\Psr\Http\Client\NetworkExceptionInterface;
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
/**
 * Exception thrown when a connection cannot be established.
 *
 * Note that no response is present for a ConnectException
 */
<<<<<<< HEAD
class ConnectException extends \YoastSEO_Vendor\GuzzleHttp\Exception\TransferException implements \YoastSEO_Vendor\Psr\Http\Client\NetworkExceptionInterface
{
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var array
     */
    private $handlerContext;
    public function __construct(string $message, \YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \Throwable $previous = null, array $handlerContext = [])
    {
        parent::__construct($message, 0, $previous);
        $this->request = $request;
        $this->handlerContext = $handlerContext;
    }
    /**
     * Get the request that caused the exception
     */
    public function getRequest() : \YoastSEO_Vendor\Psr\Http\Message\RequestInterface
    {
        return $this->request;
    }
    /**
     * Get contextual information about the error from the underlying handler.
     *
     * The contents of this array will vary depending on which handler you are
     * using. It may also be just an empty array. Relying on this data will
     * couple you to a specific handler, but can give more debug information
     * when needed.
     */
    public function getHandlerContext() : array
    {
        return $this->handlerContext;
=======
class ConnectException extends \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException
{
    public function __construct($message, \YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \Exception $previous = null, array $handlerContext = [])
    {
        parent::__construct($message, $request, null, $previous, $handlerContext);
    }
    /**
     * @return null
     */
    public function getResponse()
    {
        return null;
    }
    /**
     * @return bool
     */
    public function hasResponse()
    {
        return \false;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    }
}
