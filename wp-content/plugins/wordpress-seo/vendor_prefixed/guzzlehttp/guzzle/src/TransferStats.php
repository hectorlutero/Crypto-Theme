<?php

namespace YoastSEO_Vendor\GuzzleHttp;

use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\ResponseInterface;
use YoastSEO_Vendor\Psr\Http\Message\UriInterface;
/**
 * Represents data at the point after it was transferred either successfully
 * or after a network error.
 */
final class TransferStats
{
<<<<<<< HEAD
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var ResponseInterface|null
     */
    private $response;
    /**
     * @var float|null
     */
    private $transferTime;
    /**
     * @var array
     */
    private $handlerStats;
    /**
     * @var mixed|null
     */
=======
    private $request;
    private $response;
    private $transferTime;
    private $handlerStats;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    private $handlerErrorData;
    /**
     * @param RequestInterface       $request          Request that was sent.
     * @param ResponseInterface|null $response         Response received (if any)
     * @param float|null             $transferTime     Total handler transfer time.
     * @param mixed                  $handlerErrorData Handler error data.
     * @param array                  $handlerStats     Handler specific stats.
     */
<<<<<<< HEAD
    public function __construct(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response = null, float $transferTime = null, $handlerErrorData = null, array $handlerStats = [])
=======
    public function __construct(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response = null, $transferTime = null, $handlerErrorData = null, $handlerStats = [])
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->request = $request;
        $this->response = $response;
        $this->transferTime = $transferTime;
        $this->handlerErrorData = $handlerErrorData;
        $this->handlerStats = $handlerStats;
    }
<<<<<<< HEAD
    public function getRequest() : \YoastSEO_Vendor\Psr\Http\Message\RequestInterface
=======
    /**
     * @return RequestInterface
     */
    public function getRequest()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->request;
    }
    /**
     * Returns the response that was received (if any).
<<<<<<< HEAD
     */
    public function getResponse() : ?\YoastSEO_Vendor\Psr\Http\Message\ResponseInterface
=======
     *
     * @return ResponseInterface|null
     */
    public function getResponse()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->response;
    }
    /**
     * Returns true if a response was received.
<<<<<<< HEAD
     */
    public function hasResponse() : bool
=======
     *
     * @return bool
     */
    public function hasResponse()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->response !== null;
    }
    /**
     * Gets handler specific error data.
     *
     * This might be an exception, a integer representing an error code, or
     * anything else. Relying on this value assumes that you know what handler
     * you are using.
     *
     * @return mixed
     */
    public function getHandlerErrorData()
    {
        return $this->handlerErrorData;
    }
    /**
     * Get the effective URI the request was sent to.
<<<<<<< HEAD
     */
    public function getEffectiveUri() : \YoastSEO_Vendor\Psr\Http\Message\UriInterface
=======
     *
     * @return UriInterface
     */
    public function getEffectiveUri()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->request->getUri();
    }
    /**
     * Get the estimated time the request was being transferred by the handler.
     *
     * @return float|null Time in seconds.
     */
<<<<<<< HEAD
    public function getTransferTime() : ?float
=======
    public function getTransferTime()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->transferTime;
    }
    /**
     * Gets an array of all of the handler specific transfer data.
<<<<<<< HEAD
     */
    public function getHandlerStats() : array
=======
     *
     * @return array
     */
    public function getHandlerStats()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->handlerStats;
    }
    /**
     * Get a specific handler statistic from the handler by name.
     *
     * @param string $stat Handler specific transfer stat to retrieve.
     *
     * @return mixed|null
     */
<<<<<<< HEAD
    public function getHandlerStat(string $stat)
    {
        return $this->handlerStats[$stat] ?? null;
=======
    public function getHandlerStat($stat)
    {
        return isset($this->handlerStats[$stat]) ? $this->handlerStats[$stat] : null;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    }
}
