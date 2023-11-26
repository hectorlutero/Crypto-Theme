<?php

namespace YoastSEO_Vendor\GuzzleHttp\Exception;

<<<<<<< HEAD
use YoastSEO_Vendor\GuzzleHttp\BodySummarizer;
use YoastSEO_Vendor\GuzzleHttp\BodySummarizerInterface;
use YoastSEO_Vendor\Psr\Http\Client\RequestExceptionInterface;
=======
use YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\ResponseInterface;
use YoastSEO_Vendor\Psr\Http\Message\UriInterface;
/**
 * HTTP Request exception
 */
<<<<<<< HEAD
class RequestException extends \YoastSEO_Vendor\GuzzleHttp\Exception\TransferException implements \YoastSEO_Vendor\Psr\Http\Client\RequestExceptionInterface
{
    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var ResponseInterface|null
     */
    private $response;
    /**
     * @var array
     */
    private $handlerContext;
    public function __construct(string $message, \YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response = null, \Throwable $previous = null, array $handlerContext = [])
    {
        // Set the code of the exception if the response is set and not future.
        $code = $response ? $response->getStatusCode() : 0;
=======
class RequestException extends \YoastSEO_Vendor\GuzzleHttp\Exception\TransferException
{
    /** @var RequestInterface */
    private $request;
    /** @var ResponseInterface|null */
    private $response;
    /** @var array */
    private $handlerContext;
    public function __construct($message, \YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response = null, \Exception $previous = null, array $handlerContext = [])
    {
        // Set the code of the exception if the response is set and not future.
        $code = $response && !$response instanceof \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface ? $response->getStatusCode() : 0;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        parent::__construct($message, $code, $previous);
        $this->request = $request;
        $this->response = $response;
        $this->handlerContext = $handlerContext;
    }
    /**
     * Wrap non-RequestExceptions with a RequestException
<<<<<<< HEAD
     */
    public static function wrapException(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \Throwable $e) : \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException
=======
     *
     * @param RequestInterface $request
     * @param \Exception       $e
     *
     * @return RequestException
     */
    public static function wrapException(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \Exception $e)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $e instanceof \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException ? $e : new \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException($e->getMessage(), $request, null, $e);
    }
    /**
     * Factory method to create a new exception with a normalized error message
     *
<<<<<<< HEAD
     * @param RequestInterface             $request        Request sent
     * @param ResponseInterface            $response       Response received
     * @param \Throwable|null              $previous       Previous exception
     * @param array                        $handlerContext Optional handler context
     * @param BodySummarizerInterface|null $bodySummarizer Optional body summarizer
     */
    public static function create(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response = null, \Throwable $previous = null, array $handlerContext = [], \YoastSEO_Vendor\GuzzleHttp\BodySummarizerInterface $bodySummarizer = null) : self
    {
        if (!$response) {
            return new self('Error completing request', $request, null, $previous, $handlerContext);
=======
     * @param RequestInterface  $request  Request
     * @param ResponseInterface $response Response received
     * @param \Exception        $previous Previous exception
     * @param array             $ctx      Optional handler context.
     *
     * @return self
     */
    public static function create(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response = null, \Exception $previous = null, array $ctx = [])
    {
        if (!$response) {
            return new self('Error completing request', $request, null, $previous, $ctx);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        }
        $level = (int) \floor($response->getStatusCode() / 100);
        if ($level === 4) {
            $label = 'Client error';
            $className = \YoastSEO_Vendor\GuzzleHttp\Exception\ClientException::class;
        } elseif ($level === 5) {
            $label = 'Server error';
            $className = \YoastSEO_Vendor\GuzzleHttp\Exception\ServerException::class;
        } else {
            $label = 'Unsuccessful request';
            $className = __CLASS__;
        }
        $uri = $request->getUri();
        $uri = static::obfuscateUri($uri);
        // Client Error: `GET /` resulted in a `404 Not Found` response:
        // <html> ... (truncated)
<<<<<<< HEAD
        $message = \sprintf('%s: `%s %s` resulted in a `%s %s` response', $label, $request->getMethod(), $uri->__toString(), $response->getStatusCode(), $response->getReasonPhrase());
        $summary = ($bodySummarizer ?? new \YoastSEO_Vendor\GuzzleHttp\BodySummarizer())->summarize($response);
        if ($summary !== null) {
            $message .= ":\n{$summary}\n";
        }
        return new $className($message, $request, $response, $previous, $handlerContext);
    }
    /**
     * Obfuscates URI if there is a username and a password present
     */
    private static function obfuscateUri(\YoastSEO_Vendor\Psr\Http\Message\UriInterface $uri) : \YoastSEO_Vendor\Psr\Http\Message\UriInterface
=======
        $message = \sprintf('%s: `%s %s` resulted in a `%s %s` response', $label, $request->getMethod(), $uri, $response->getStatusCode(), $response->getReasonPhrase());
        $summary = static::getResponseBodySummary($response);
        if ($summary !== null) {
            $message .= ":\n{$summary}\n";
        }
        return new $className($message, $request, $response, $previous, $ctx);
    }
    /**
     * Get a short summary of the response
     *
     * Will return `null` if the response is not printable.
     *
     * @param ResponseInterface $response
     *
     * @return string|null
     */
    public static function getResponseBodySummary(\YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response)
    {
        return \YoastSEO_Vendor\GuzzleHttp\Psr7\get_message_body_summary($response);
    }
    /**
     * Obfuscates URI if there is a username and a password present
     *
     * @param UriInterface $uri
     *
     * @return UriInterface
     */
    private static function obfuscateUri(\YoastSEO_Vendor\Psr\Http\Message\UriInterface $uri)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $userInfo = $uri->getUserInfo();
        if (\false !== ($pos = \strpos($userInfo, ':'))) {
            return $uri->withUserInfo(\substr($userInfo, 0, $pos), '***');
        }
        return $uri;
    }
    /**
     * Get the request that caused the exception
<<<<<<< HEAD
     */
    public function getRequest() : \YoastSEO_Vendor\Psr\Http\Message\RequestInterface
=======
     *
     * @return RequestInterface
     */
    public function getRequest()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->request;
    }
    /**
     * Get the associated response
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
     * Check if a response was received
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
     * Get contextual information about the error from the underlying handler.
     *
     * The contents of this array will vary depending on which handler you are
     * using. It may also be just an empty array. Relying on this data will
     * couple you to a specific handler, but can give more debug information
     * when needed.
<<<<<<< HEAD
     */
    public function getHandlerContext() : array
=======
     *
     * @return array
     */
    public function getHandlerContext()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->handlerContext;
    }
}
