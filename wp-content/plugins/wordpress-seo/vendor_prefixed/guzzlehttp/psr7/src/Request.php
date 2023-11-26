<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use InvalidArgumentException;
use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
use YoastSEO_Vendor\Psr\Http\Message\UriInterface;
/**
 * PSR-7 request implementation.
 */
class Request implements \YoastSEO_Vendor\Psr\Http\Message\RequestInterface
{
    use MessageTrait;
    /** @var string */
    private $method;
    /** @var string|null */
    private $requestTarget;
    /** @var UriInterface */
    private $uri;
    /**
     * @param string                               $method  HTTP method
     * @param string|UriInterface                  $uri     URI
<<<<<<< HEAD
     * @param array<string, string|string[]>       $headers Request headers
     * @param string|resource|StreamInterface|null $body    Request body
     * @param string                               $version Protocol version
     */
    public function __construct(string $method, $uri, array $headers = [], $body = null, string $version = '1.1')
=======
     * @param array                                $headers Request headers
     * @param string|resource|StreamInterface|null $body    Request body
     * @param string                               $version Protocol version
     */
    public function __construct($method, $uri, array $headers = [], $body = null, $version = '1.1')
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->assertMethod($method);
        if (!$uri instanceof \YoastSEO_Vendor\Psr\Http\Message\UriInterface) {
            $uri = new \YoastSEO_Vendor\GuzzleHttp\Psr7\Uri($uri);
        }
        $this->method = \strtoupper($method);
        $this->uri = $uri;
        $this->setHeaders($headers);
        $this->protocol = $version;
        if (!isset($this->headerNames['host'])) {
            $this->updateHostFromUri();
        }
        if ($body !== '' && $body !== null) {
            $this->stream = \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::streamFor($body);
        }
    }
<<<<<<< HEAD
    public function getRequestTarget() : string
=======
    public function getRequestTarget()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($this->requestTarget !== null) {
            return $this->requestTarget;
        }
        $target = $this->uri->getPath();
<<<<<<< HEAD
        if ($target === '') {
=======
        if ($target == '') {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $target = '/';
        }
        if ($this->uri->getQuery() != '') {
            $target .= '?' . $this->uri->getQuery();
        }
        return $target;
    }
<<<<<<< HEAD
    public function withRequestTarget($requestTarget) : \YoastSEO_Vendor\Psr\Http\Message\RequestInterface
=======
    public function withRequestTarget($requestTarget)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (\preg_match('#\\s#', $requestTarget)) {
            throw new \InvalidArgumentException('Invalid request target provided; cannot contain whitespace');
        }
        $new = clone $this;
        $new->requestTarget = $requestTarget;
        return $new;
    }
<<<<<<< HEAD
    public function getMethod() : string
    {
        return $this->method;
    }
    public function withMethod($method) : \YoastSEO_Vendor\Psr\Http\Message\RequestInterface
=======
    public function getMethod()
    {
        return $this->method;
    }
    public function withMethod($method)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->assertMethod($method);
        $new = clone $this;
        $new->method = \strtoupper($method);
        return $new;
    }
<<<<<<< HEAD
    public function getUri() : \YoastSEO_Vendor\Psr\Http\Message\UriInterface
    {
        return $this->uri;
    }
    public function withUri(\YoastSEO_Vendor\Psr\Http\Message\UriInterface $uri, $preserveHost = \false) : \YoastSEO_Vendor\Psr\Http\Message\RequestInterface
=======
    public function getUri()
    {
        return $this->uri;
    }
    public function withUri(\YoastSEO_Vendor\Psr\Http\Message\UriInterface $uri, $preserveHost = \false)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($uri === $this->uri) {
            return $this;
        }
        $new = clone $this;
        $new->uri = $uri;
        if (!$preserveHost || !isset($this->headerNames['host'])) {
            $new->updateHostFromUri();
        }
        return $new;
    }
<<<<<<< HEAD
    private function updateHostFromUri() : void
=======
    private function updateHostFromUri()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $host = $this->uri->getHost();
        if ($host == '') {
            return;
        }
        if (($port = $this->uri->getPort()) !== null) {
            $host .= ':' . $port;
        }
        if (isset($this->headerNames['host'])) {
            $header = $this->headerNames['host'];
        } else {
            $header = 'Host';
            $this->headerNames['host'] = 'Host';
        }
        // Ensure Host is the first header.
        // See: http://tools.ietf.org/html/rfc7230#section-5.4
        $this->headers = [$header => [$host]] + $this->headers;
    }
<<<<<<< HEAD
    /**
     * @param mixed $method
     */
    private function assertMethod($method) : void
=======
    private function assertMethod($method)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!\is_string($method) || $method === '') {
            throw new \InvalidArgumentException('Method must be a non-empty string.');
        }
    }
}