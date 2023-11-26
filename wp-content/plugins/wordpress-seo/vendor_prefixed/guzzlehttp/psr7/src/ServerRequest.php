<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use InvalidArgumentException;
use YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
use YoastSEO_Vendor\Psr\Http\Message\UploadedFileInterface;
use YoastSEO_Vendor\Psr\Http\Message\UriInterface;
/**
 * Server-side HTTP request
 *
 * Extends the Request definition to add methods for accessing incoming data,
 * specifically server parameters, cookies, matched path parameters, query
 * string arguments, body parameters, and upload file information.
 *
 * "Attributes" are discovered via decomposing the request (and usually
 * specifically the URI path), and typically will be injected by the application.
 *
 * Requests are considered immutable; all methods that might change state are
 * implemented such that they retain the internal state of the current
 * message and return a new instance that contains the changed state.
 */
class ServerRequest extends \YoastSEO_Vendor\GuzzleHttp\Psr7\Request implements \YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface
{
    /**
     * @var array
     */
    private $attributes = [];
    /**
     * @var array
     */
    private $cookieParams = [];
    /**
     * @var array|object|null
     */
    private $parsedBody;
    /**
     * @var array
     */
    private $queryParams = [];
    /**
     * @var array
     */
    private $serverParams;
    /**
     * @var array
     */
    private $uploadedFiles = [];
    /**
     * @param string                               $method       HTTP method
     * @param string|UriInterface                  $uri          URI
<<<<<<< HEAD
     * @param array<string, string|string[]>       $headers      Request headers
=======
     * @param array                                $headers      Request headers
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     * @param string|resource|StreamInterface|null $body         Request body
     * @param string                               $version      Protocol version
     * @param array                                $serverParams Typically the $_SERVER superglobal
     */
<<<<<<< HEAD
    public function __construct(string $method, $uri, array $headers = [], $body = null, string $version = '1.1', array $serverParams = [])
=======
    public function __construct($method, $uri, array $headers = [], $body = null, $version = '1.1', array $serverParams = [])
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->serverParams = $serverParams;
        parent::__construct($method, $uri, $headers, $body, $version);
    }
    /**
     * Return an UploadedFile instance array.
     *
<<<<<<< HEAD
     * @param array $files An array which respect $_FILES structure
     *
     * @throws InvalidArgumentException for unrecognized values
     */
    public static function normalizeFiles(array $files) : array
=======
     * @param array $files A array which respect $_FILES structure
     *
     * @return array
     *
     * @throws InvalidArgumentException for unrecognized values
     */
    public static function normalizeFiles(array $files)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $normalized = [];
        foreach ($files as $key => $value) {
            if ($value instanceof \YoastSEO_Vendor\Psr\Http\Message\UploadedFileInterface) {
                $normalized[$key] = $value;
            } elseif (\is_array($value) && isset($value['tmp_name'])) {
                $normalized[$key] = self::createUploadedFileFromSpec($value);
            } elseif (\is_array($value)) {
                $normalized[$key] = self::normalizeFiles($value);
                continue;
            } else {
                throw new \InvalidArgumentException('Invalid value in files specification');
            }
        }
        return $normalized;
    }
    /**
     * Create and return an UploadedFile instance from a $_FILES specification.
     *
     * If the specification represents an array of values, this method will
     * delegate to normalizeNestedFileSpec() and return that return value.
     *
     * @param array $value $_FILES struct
     *
<<<<<<< HEAD
     * @return UploadedFileInterface|UploadedFileInterface[]
=======
     * @return array|UploadedFileInterface
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    private static function createUploadedFileFromSpec(array $value)
    {
        if (\is_array($value['tmp_name'])) {
            return self::normalizeNestedFileSpec($value);
        }
        return new \YoastSEO_Vendor\GuzzleHttp\Psr7\UploadedFile($value['tmp_name'], (int) $value['size'], (int) $value['error'], $value['name'], $value['type']);
    }
    /**
     * Normalize an array of file specifications.
     *
     * Loops through all nested files and returns a normalized array of
     * UploadedFileInterface instances.
     *
<<<<<<< HEAD
     * @return UploadedFileInterface[]
     */
    private static function normalizeNestedFileSpec(array $files = []) : array
    {
        $normalizedFiles = [];
        foreach (\array_keys($files['tmp_name']) as $key) {
            $spec = ['tmp_name' => $files['tmp_name'][$key], 'size' => $files['size'][$key] ?? null, 'error' => $files['error'][$key] ?? null, 'name' => $files['name'][$key] ?? null, 'type' => $files['type'][$key] ?? null];
=======
     * @param array $files
     *
     * @return UploadedFileInterface[]
     */
    private static function normalizeNestedFileSpec(array $files = [])
    {
        $normalizedFiles = [];
        foreach (\array_keys($files['tmp_name']) as $key) {
            $spec = ['tmp_name' => $files['tmp_name'][$key], 'size' => $files['size'][$key], 'error' => $files['error'][$key], 'name' => $files['name'][$key], 'type' => $files['type'][$key]];
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $normalizedFiles[$key] = self::createUploadedFileFromSpec($spec);
        }
        return $normalizedFiles;
    }
    /**
     * Return a ServerRequest populated with superglobals:
     * $_GET
     * $_POST
     * $_COOKIE
     * $_FILES
     * $_SERVER
<<<<<<< HEAD
     */
    public static function fromGlobals() : \YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
=======
     *
     * @return ServerRequestInterface
     */
    public static function fromGlobals()
    {
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        $headers = \getallheaders();
        $uri = self::getUriFromGlobals();
        $body = new \YoastSEO_Vendor\GuzzleHttp\Psr7\CachingStream(new \YoastSEO_Vendor\GuzzleHttp\Psr7\LazyOpenStream('php://input', 'r+'));
        $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? \str_replace('HTTP/', '', $_SERVER['SERVER_PROTOCOL']) : '1.1';
        $serverRequest = new \YoastSEO_Vendor\GuzzleHttp\Psr7\ServerRequest($method, $uri, $headers, $body, $protocol, $_SERVER);
        return $serverRequest->withCookieParams($_COOKIE)->withQueryParams($_GET)->withParsedBody($_POST)->withUploadedFiles(self::normalizeFiles($_FILES));
    }
<<<<<<< HEAD
    private static function extractHostAndPortFromAuthority(string $authority) : array
=======
    private static function extractHostAndPortFromAuthority($authority)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $uri = 'http://' . $authority;
        $parts = \parse_url($uri);
        if (\false === $parts) {
            return [null, null];
        }
<<<<<<< HEAD
        $host = $parts['host'] ?? null;
        $port = $parts['port'] ?? null;
=======
        $host = isset($parts['host']) ? $parts['host'] : null;
        $port = isset($parts['port']) ? $parts['port'] : null;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        return [$host, $port];
    }
    /**
     * Get a Uri populated with values from $_SERVER.
<<<<<<< HEAD
     */
    public static function getUriFromGlobals() : \YoastSEO_Vendor\Psr\Http\Message\UriInterface
=======
     *
     * @return UriInterface
     */
    public static function getUriFromGlobals()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $uri = new \YoastSEO_Vendor\GuzzleHttp\Psr7\Uri('');
        $uri = $uri->withScheme(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http');
        $hasPort = \false;
        if (isset($_SERVER['HTTP_HOST'])) {
<<<<<<< HEAD
            [$host, $port] = self::extractHostAndPortFromAuthority($_SERVER['HTTP_HOST']);
=======
            list($host, $port) = self::extractHostAndPortFromAuthority($_SERVER['HTTP_HOST']);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            if ($host !== null) {
                $uri = $uri->withHost($host);
            }
            if ($port !== null) {
                $hasPort = \true;
                $uri = $uri->withPort($port);
            }
        } elseif (isset($_SERVER['SERVER_NAME'])) {
            $uri = $uri->withHost($_SERVER['SERVER_NAME']);
        } elseif (isset($_SERVER['SERVER_ADDR'])) {
            $uri = $uri->withHost($_SERVER['SERVER_ADDR']);
        }
        if (!$hasPort && isset($_SERVER['SERVER_PORT'])) {
            $uri = $uri->withPort($_SERVER['SERVER_PORT']);
        }
        $hasQuery = \false;
        if (isset($_SERVER['REQUEST_URI'])) {
            $requestUriParts = \explode('?', $_SERVER['REQUEST_URI'], 2);
            $uri = $uri->withPath($requestUriParts[0]);
            if (isset($requestUriParts[1])) {
                $hasQuery = \true;
                $uri = $uri->withQuery($requestUriParts[1]);
            }
        }
        if (!$hasQuery && isset($_SERVER['QUERY_STRING'])) {
            $uri = $uri->withQuery($_SERVER['QUERY_STRING']);
        }
        return $uri;
    }
<<<<<<< HEAD
    public function getServerParams() : array
    {
        return $this->serverParams;
    }
    public function getUploadedFiles() : array
    {
        return $this->uploadedFiles;
    }
    public function withUploadedFiles(array $uploadedFiles) : \YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface
=======
    /**
     * {@inheritdoc}
     */
    public function getServerParams()
    {
        return $this->serverParams;
    }
    /**
     * {@inheritdoc}
     */
    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }
    /**
     * {@inheritdoc}
     */
    public function withUploadedFiles(array $uploadedFiles)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $new = clone $this;
        $new->uploadedFiles = $uploadedFiles;
        return $new;
    }
<<<<<<< HEAD
    public function getCookieParams() : array
    {
        return $this->cookieParams;
    }
    public function withCookieParams(array $cookies) : \YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface
=======
    /**
     * {@inheritdoc}
     */
    public function getCookieParams()
    {
        return $this->cookieParams;
    }
    /**
     * {@inheritdoc}
     */
    public function withCookieParams(array $cookies)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $new = clone $this;
        $new->cookieParams = $cookies;
        return $new;
    }
<<<<<<< HEAD
    public function getQueryParams() : array
    {
        return $this->queryParams;
    }
    public function withQueryParams(array $query) : \YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface
=======
    /**
     * {@inheritdoc}
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }
    /**
     * {@inheritdoc}
     */
    public function withQueryParams(array $query)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $new = clone $this;
        $new->queryParams = $query;
        return $new;
    }
    /**
<<<<<<< HEAD
     * @return array|object|null
=======
     * {@inheritdoc}
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function getParsedBody()
    {
        return $this->parsedBody;
    }
<<<<<<< HEAD
    public function withParsedBody($data) : \YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface
=======
    /**
     * {@inheritdoc}
     */
    public function withParsedBody($data)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $new = clone $this;
        $new->parsedBody = $data;
        return $new;
    }
<<<<<<< HEAD
    public function getAttributes() : array
=======
    /**
     * {@inheritdoc}
     */
    public function getAttributes()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->attributes;
    }
    /**
<<<<<<< HEAD
     * @return mixed
=======
     * {@inheritdoc}
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function getAttribute($attribute, $default = null)
    {
        if (\false === \array_key_exists($attribute, $this->attributes)) {
            return $default;
        }
        return $this->attributes[$attribute];
    }
<<<<<<< HEAD
    public function withAttribute($attribute, $value) : \YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface
=======
    /**
     * {@inheritdoc}
     */
    public function withAttribute($attribute, $value)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $new = clone $this;
        $new->attributes[$attribute] = $value;
        return $new;
    }
<<<<<<< HEAD
    public function withoutAttribute($attribute) : \YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface
=======
    /**
     * {@inheritdoc}
     */
    public function withoutAttribute($attribute)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (\false === \array_key_exists($attribute, $this->attributes)) {
            return $this;
        }
        $new = clone $this;
        unset($new->attributes[$attribute]);
        return $new;
    }
}
