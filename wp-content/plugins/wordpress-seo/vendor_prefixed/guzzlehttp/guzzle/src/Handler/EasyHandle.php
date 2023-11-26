<?php

namespace YoastSEO_Vendor\GuzzleHttp\Handler;

use YoastSEO_Vendor\GuzzleHttp\Psr7\Response;
<<<<<<< HEAD
use YoastSEO_Vendor\GuzzleHttp\Utils;
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\ResponseInterface;
use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
/**
 * Represents a cURL easy handle and the data it populates.
 *
 * @internal
 */
final class EasyHandle
{
<<<<<<< HEAD
    /**
     * @var resource|\CurlHandle cURL resource
     */
    public $handle;
    /**
     * @var StreamInterface Where data is being written
     */
    public $sink;
    /**
     * @var array Received HTTP headers so far
     */
    public $headers = [];
    /**
     * @var ResponseInterface|null Received response (if any)
     */
    public $response;
    /**
     * @var RequestInterface Request being sent
     */
    public $request;
    /**
     * @var array Request options
     */
    public $options = [];
    /**
     * @var int cURL error number (if any)
     */
    public $errno = 0;
    /**
     * @var \Throwable|null Exception during on_headers (if any)
     */
    public $onHeadersException;
    /**
     * @var \Exception|null Exception during createResponse (if any)
     */
    public $createResponseException;
    /**
     * Attach a response to the easy handle based on the received headers.
     *
     * @throws \RuntimeException if no headers have been received or the first
     *                           header line is invalid.
     */
    public function createResponse() : void
    {
        [$ver, $status, $reason, $headers] = \YoastSEO_Vendor\GuzzleHttp\Handler\HeaderProcessor::parseHeaders($this->headers);
        $normalizedKeys = \YoastSEO_Vendor\GuzzleHttp\Utils::normalizeHeaderKeys($headers);
=======
    /** @var resource cURL resource */
    public $handle;
    /** @var StreamInterface Where data is being written */
    public $sink;
    /** @var array Received HTTP headers so far */
    public $headers = [];
    /** @var ResponseInterface Received response (if any) */
    public $response;
    /** @var RequestInterface Request being sent */
    public $request;
    /** @var array Request options */
    public $options = [];
    /** @var int cURL error number (if any) */
    public $errno = 0;
    /** @var \Exception Exception during on_headers (if any) */
    public $onHeadersException;
    /**
     * Attach a response to the easy handle based on the received headers.
     *
     * @throws \RuntimeException if no headers have been received.
     */
    public function createResponse()
    {
        if (empty($this->headers)) {
            throw new \RuntimeException('No headers have been received');
        }
        // HTTP-version SP status-code SP reason-phrase
        $startLine = \explode(' ', \array_shift($this->headers), 3);
        $headers = \YoastSEO_Vendor\GuzzleHttp\headers_from_lines($this->headers);
        $normalizedKeys = \YoastSEO_Vendor\GuzzleHttp\normalize_header_keys($headers);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        if (!empty($this->options['decode_content']) && isset($normalizedKeys['content-encoding'])) {
            $headers['x-encoded-content-encoding'] = $headers[$normalizedKeys['content-encoding']];
            unset($headers[$normalizedKeys['content-encoding']]);
            if (isset($normalizedKeys['content-length'])) {
                $headers['x-encoded-content-length'] = $headers[$normalizedKeys['content-length']];
                $bodyLength = (int) $this->sink->getSize();
                if ($bodyLength) {
                    $headers[$normalizedKeys['content-length']] = $bodyLength;
                } else {
                    unset($headers[$normalizedKeys['content-length']]);
                }
            }
        }
        // Attach a response to the easy handle with the parsed headers.
<<<<<<< HEAD
        $this->response = new \YoastSEO_Vendor\GuzzleHttp\Psr7\Response($status, $headers, $this->sink, $ver, $reason);
    }
    /**
     * @param string $name
     *
     * @return void
     *
     * @throws \BadMethodCallException
     */
=======
        $this->response = new \YoastSEO_Vendor\GuzzleHttp\Psr7\Response($startLine[1], $headers, $this->sink, \substr($startLine[0], 5), isset($startLine[2]) ? (string) $startLine[2] : null);
    }
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    public function __get($name)
    {
        $msg = $name === 'handle' ? 'The EasyHandle has been released' : 'Invalid property: ' . $name;
        throw new \BadMethodCallException($msg);
    }
}
