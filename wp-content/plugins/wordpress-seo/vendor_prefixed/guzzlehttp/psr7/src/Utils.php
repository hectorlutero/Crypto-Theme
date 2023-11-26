<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
use YoastSEO_Vendor\Psr\Http\Message\UriInterface;
final class Utils
{
    /**
     * Remove the items given by the keys, case insensitively from the data.
     *
<<<<<<< HEAD
     * @param string[] $keys
     */
    public static function caselessRemove(array $keys, array $data) : array
=======
     * @param iterable<string> $keys
     *
     * @return array
     */
    public static function caselessRemove($keys, array $data)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $result = [];
        foreach ($keys as &$key) {
            $key = \strtolower($key);
        }
        foreach ($data as $k => $v) {
<<<<<<< HEAD
            if (!\is_string($k) || !\in_array(\strtolower($k), $keys)) {
=======
            if (!\in_array(\strtolower($k), $keys)) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                $result[$k] = $v;
            }
        }
        return $result;
    }
    /**
     * Copy the contents of a stream into another stream until the given number
     * of bytes have been read.
     *
     * @param StreamInterface $source Stream to read from
     * @param StreamInterface $dest   Stream to write to
     * @param int             $maxLen Maximum number of bytes to read. Pass -1
     *                                to read the entire stream.
     *
     * @throws \RuntimeException on error.
     */
<<<<<<< HEAD
    public static function copyToStream(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $source, \YoastSEO_Vendor\Psr\Http\Message\StreamInterface $dest, int $maxLen = -1) : void
=======
    public static function copyToStream(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $source, \YoastSEO_Vendor\Psr\Http\Message\StreamInterface $dest, $maxLen = -1)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $bufferSize = 8192;
        if ($maxLen === -1) {
            while (!$source->eof()) {
                if (!$dest->write($source->read($bufferSize))) {
                    break;
                }
            }
        } else {
            $remaining = $maxLen;
            while ($remaining > 0 && !$source->eof()) {
                $buf = $source->read(\min($bufferSize, $remaining));
                $len = \strlen($buf);
                if (!$len) {
                    break;
                }
                $remaining -= $len;
                $dest->write($buf);
            }
        }
    }
    /**
     * Copy the contents of a stream into a string until the given number of
     * bytes have been read.
     *
     * @param StreamInterface $stream Stream to read
     * @param int             $maxLen Maximum number of bytes to read. Pass -1
     *                                to read the entire stream.
     *
<<<<<<< HEAD
     * @throws \RuntimeException on error.
     */
    public static function copyToString(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, int $maxLen = -1) : string
=======
     * @return string
     *
     * @throws \RuntimeException on error.
     */
    public static function copyToString(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, $maxLen = -1)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $buffer = '';
        if ($maxLen === -1) {
            while (!$stream->eof()) {
                $buf = $stream->read(1048576);
<<<<<<< HEAD
                if ($buf === '') {
=======
                // Using a loose equality here to match on '' and false.
                if ($buf == null) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                    break;
                }
                $buffer .= $buf;
            }
            return $buffer;
        }
        $len = 0;
        while (!$stream->eof() && $len < $maxLen) {
            $buf = $stream->read($maxLen - $len);
<<<<<<< HEAD
            if ($buf === '') {
=======
            // Using a loose equality here to match on '' and false.
            if ($buf == null) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                break;
            }
            $buffer .= $buf;
            $len = \strlen($buffer);
        }
        return $buffer;
    }
    /**
     * Calculate a hash of a stream.
     *
     * This method reads the entire stream to calculate a rolling hash, based
     * on PHP's `hash_init` functions.
     *
     * @param StreamInterface $stream    Stream to calculate the hash for
     * @param string          $algo      Hash algorithm (e.g. md5, crc32, etc)
     * @param bool            $rawOutput Whether or not to use raw output
     *
<<<<<<< HEAD
     * @throws \RuntimeException on error.
     */
    public static function hash(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, string $algo, bool $rawOutput = \false) : string
=======
     * @return string Returns the hash of the stream
     *
     * @throws \RuntimeException on error.
     */
    public static function hash(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, $algo, $rawOutput = \false)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $pos = $stream->tell();
        if ($pos > 0) {
            $stream->rewind();
        }
        $ctx = \hash_init($algo);
        while (!$stream->eof()) {
            \hash_update($ctx, $stream->read(1048576));
        }
<<<<<<< HEAD
        $out = \hash_final($ctx, $rawOutput);
=======
        $out = \hash_final($ctx, (bool) $rawOutput);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        $stream->seek($pos);
        return $out;
    }
    /**
     * Clone and modify a request with the given changes.
     *
     * This method is useful for reducing the number of clones needed to mutate
     * a message.
     *
     * The changes can be one of:
     * - method: (string) Changes the HTTP method.
     * - set_headers: (array) Sets the given headers.
     * - remove_headers: (array) Remove the given headers.
     * - body: (mixed) Sets the given body.
     * - uri: (UriInterface) Set the URI.
     * - query: (string) Set the query string value of the URI.
     * - version: (string) Set the protocol version.
     *
     * @param RequestInterface $request Request to clone and modify.
     * @param array            $changes Changes to apply.
<<<<<<< HEAD
     */
    public static function modifyRequest(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $changes) : \YoastSEO_Vendor\Psr\Http\Message\RequestInterface
=======
     *
     * @return RequestInterface
     */
    public static function modifyRequest(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $changes)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!$changes) {
            return $request;
        }
        $headers = $request->getHeaders();
        if (!isset($changes['uri'])) {
            $uri = $request->getUri();
        } else {
            // Remove the host header if one is on the URI
            if ($host = $changes['uri']->getHost()) {
                $changes['set_headers']['Host'] = $host;
                if ($port = $changes['uri']->getPort()) {
                    $standardPorts = ['http' => 80, 'https' => 443];
                    $scheme = $changes['uri']->getScheme();
                    if (isset($standardPorts[$scheme]) && $port != $standardPorts[$scheme]) {
                        $changes['set_headers']['Host'] .= ':' . $port;
                    }
                }
            }
            $uri = $changes['uri'];
        }
        if (!empty($changes['remove_headers'])) {
            $headers = self::caselessRemove($changes['remove_headers'], $headers);
        }
        if (!empty($changes['set_headers'])) {
            $headers = self::caselessRemove(\array_keys($changes['set_headers']), $headers);
            $headers = $changes['set_headers'] + $headers;
        }
        if (isset($changes['query'])) {
            $uri = $uri->withQuery($changes['query']);
        }
        if ($request instanceof \YoastSEO_Vendor\Psr\Http\Message\ServerRequestInterface) {
<<<<<<< HEAD
            $new = (new \YoastSEO_Vendor\GuzzleHttp\Psr7\ServerRequest($changes['method'] ?? $request->getMethod(), $uri, $headers, $changes['body'] ?? $request->getBody(), $changes['version'] ?? $request->getProtocolVersion(), $request->getServerParams()))->withParsedBody($request->getParsedBody())->withQueryParams($request->getQueryParams())->withCookieParams($request->getCookieParams())->withUploadedFiles($request->getUploadedFiles());
=======
            $new = (new \YoastSEO_Vendor\GuzzleHttp\Psr7\ServerRequest(isset($changes['method']) ? $changes['method'] : $request->getMethod(), $uri, $headers, isset($changes['body']) ? $changes['body'] : $request->getBody(), isset($changes['version']) ? $changes['version'] : $request->getProtocolVersion(), $request->getServerParams()))->withParsedBody($request->getParsedBody())->withQueryParams($request->getQueryParams())->withCookieParams($request->getCookieParams())->withUploadedFiles($request->getUploadedFiles());
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            foreach ($request->getAttributes() as $key => $value) {
                $new = $new->withAttribute($key, $value);
            }
            return $new;
        }
<<<<<<< HEAD
        return new \YoastSEO_Vendor\GuzzleHttp\Psr7\Request($changes['method'] ?? $request->getMethod(), $uri, $headers, $changes['body'] ?? $request->getBody(), $changes['version'] ?? $request->getProtocolVersion());
=======
        return new \YoastSEO_Vendor\GuzzleHttp\Psr7\Request(isset($changes['method']) ? $changes['method'] : $request->getMethod(), $uri, $headers, isset($changes['body']) ? $changes['body'] : $request->getBody(), isset($changes['version']) ? $changes['version'] : $request->getProtocolVersion());
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    }
    /**
     * Read a line from the stream up to the maximum allowed buffer length.
     *
     * @param StreamInterface $stream    Stream to read from
     * @param int|null        $maxLength Maximum buffer length
<<<<<<< HEAD
     */
    public static function readLine(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, int $maxLength = null) : string
=======
     *
     * @return string
     */
    public static function readLine(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, $maxLength = null)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $buffer = '';
        $size = 0;
        while (!$stream->eof()) {
<<<<<<< HEAD
            if ('' === ($byte = $stream->read(1))) {
=======
            // Using a loose equality here to match on '' and false.
            if (null == ($byte = $stream->read(1))) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                return $buffer;
            }
            $buffer .= $byte;
            // Break when a new line is found or the max length - 1 is reached
            if ($byte === "\n" || ++$size === $maxLength - 1) {
                break;
            }
        }
        return $buffer;
    }
    /**
     * Create a new stream based on the input type.
     *
     * Options is an associative array that can contain the following keys:
     * - metadata: Array of custom metadata.
     * - size: Size of the stream.
     *
     * This method accepts the following `$resource` types:
     * - `Psr\Http\Message\StreamInterface`: Returns the value as-is.
     * - `string`: Creates a stream object that uses the given string as the contents.
     * - `resource`: Creates a stream object that wraps the given PHP stream resource.
     * - `Iterator`: If the provided value implements `Iterator`, then a read-only
     *   stream object will be created that wraps the given iterable. Each time the
     *   stream is read from, data from the iterator will fill a buffer and will be
     *   continuously called until the buffer is equal to the requested read size.
     *   Subsequent read calls will first read from the buffer and then call `next`
     *   on the underlying iterator until it is exhausted.
     * - `object` with `__toString()`: If the object has the `__toString()` method,
     *   the object will be cast to a string and then a stream will be returned that
     *   uses the string value.
     * - `NULL`: When `null` is passed, an empty stream object is returned.
     * - `callable` When a callable is passed, a read-only stream object will be
     *   created that invokes the given callable. The callable is invoked with the
     *   number of suggested bytes to read. The callable can return any number of
     *   bytes, but MUST return `false` when there is no more data to return. The
     *   stream object that wraps the callable will invoke the callable until the
     *   number of requested bytes are available. Any additional bytes will be
     *   buffered and used in subsequent reads.
     *
     * @param resource|string|int|float|bool|StreamInterface|callable|\Iterator|null $resource Entity body data
<<<<<<< HEAD
     * @param array{size?: int, metadata?: array}                                    $options  Additional options
     *
     * @throws \InvalidArgumentException if the $resource arg is not valid.
     */
    public static function streamFor($resource = '', array $options = []) : \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
=======
     * @param array                                                                  $options  Additional options
     *
     * @return StreamInterface
     *
     * @throws \InvalidArgumentException if the $resource arg is not valid.
     */
    public static function streamFor($resource = '', array $options = [])
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (\is_scalar($resource)) {
            $stream = self::tryFopen('php://temp', 'r+');
            if ($resource !== '') {
<<<<<<< HEAD
                \fwrite($stream, (string) $resource);
=======
                \fwrite($stream, $resource);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                \fseek($stream, 0);
            }
            return new \YoastSEO_Vendor\GuzzleHttp\Psr7\Stream($stream, $options);
        }
        switch (\gettype($resource)) {
            case 'resource':
                /*
                 * The 'php://input' is a special stream with quirks and inconsistencies.
                 * We avoid using that stream by reading it into php://temp
                 */
<<<<<<< HEAD
                /** @var resource $resource */
                if ((\stream_get_meta_data($resource)['uri'] ?? '') === 'php://input') {
                    $stream = self::tryFopen('php://temp', 'w+');
                    \stream_copy_to_stream($resource, $stream);
=======
                $metaData = \stream_get_meta_data($resource);
                if (isset($metaData['uri']) && $metaData['uri'] === 'php://input') {
                    $stream = self::tryFopen('php://temp', 'w+');
                    \fwrite($stream, \stream_get_contents($resource));
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                    \fseek($stream, 0);
                    $resource = $stream;
                }
                return new \YoastSEO_Vendor\GuzzleHttp\Psr7\Stream($resource, $options);
            case 'object':
<<<<<<< HEAD
                /** @var object $resource */
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                if ($resource instanceof \YoastSEO_Vendor\Psr\Http\Message\StreamInterface) {
                    return $resource;
                } elseif ($resource instanceof \Iterator) {
                    return new \YoastSEO_Vendor\GuzzleHttp\Psr7\PumpStream(function () use($resource) {
                        if (!$resource->valid()) {
                            return \false;
                        }
                        $result = $resource->current();
                        $resource->next();
                        return $result;
                    }, $options);
                } elseif (\method_exists($resource, '__toString')) {
<<<<<<< HEAD
                    return self::streamFor((string) $resource, $options);
=======
                    return \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::streamFor((string) $resource, $options);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                }
                break;
            case 'NULL':
                return new \YoastSEO_Vendor\GuzzleHttp\Psr7\Stream(self::tryFopen('php://temp', 'r+'), $options);
        }
        if (\is_callable($resource)) {
            return new \YoastSEO_Vendor\GuzzleHttp\Psr7\PumpStream($resource, $options);
        }
        throw new \InvalidArgumentException('Invalid resource type: ' . \gettype($resource));
    }
    /**
     * Safely opens a PHP stream resource using a filename.
     *
     * When fopen fails, PHP normally raises a warning. This function adds an
     * error handler that checks for errors and throws an exception instead.
     *
     * @param string $filename File to open
     * @param string $mode     Mode used to open the file
     *
     * @return resource
     *
     * @throws \RuntimeException if the file cannot be opened
     */
<<<<<<< HEAD
    public static function tryFopen(string $filename, string $mode)
    {
        $ex = null;
        \set_error_handler(static function (int $errno, string $errstr) use($filename, $mode, &$ex) : bool {
            $ex = new \RuntimeException(\sprintf('Unable to open "%s" using mode "%s": %s', $filename, $mode, $errstr));
            return \true;
        });
        try {
            /** @var resource $handle */
=======
    public static function tryFopen($filename, $mode)
    {
        $ex = null;
        \set_error_handler(function () use($filename, $mode, &$ex) {
            $ex = new \RuntimeException(\sprintf('Unable to open "%s" using mode "%s": %s', $filename, $mode, \func_get_args()[1]));
            return \true;
        });
        try {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $handle = \fopen($filename, $mode);
        } catch (\Throwable $e) {
            $ex = new \RuntimeException(\sprintf('Unable to open "%s" using mode "%s": %s', $filename, $mode, $e->getMessage()), 0, $e);
        }
        \restore_error_handler();
        if ($ex) {
            /** @var $ex \RuntimeException */
            throw $ex;
        }
        return $handle;
    }
    /**
<<<<<<< HEAD
     * Safely gets the contents of a given stream.
     *
     * When stream_get_contents fails, PHP normally raises a warning. This
     * function adds an error handler that checks for errors and throws an
     * exception instead.
     *
     * @param resource $stream
     *
     * @throws \RuntimeException if the stream cannot be read
     */
    public static function tryGetContents($stream) : string
    {
        $ex = null;
        \set_error_handler(static function (int $errno, string $errstr) use(&$ex) : bool {
            $ex = new \RuntimeException(\sprintf('Unable to read stream contents: %s', $errstr));
            return \true;
        });
        try {
            /** @var string|false $contents */
            $contents = \stream_get_contents($stream);
            if ($contents === \false) {
                $ex = new \RuntimeException('Unable to read stream contents');
            }
        } catch (\Throwable $e) {
            $ex = new \RuntimeException(\sprintf('Unable to read stream contents: %s', $e->getMessage()), 0, $e);
        }
        \restore_error_handler();
        if ($ex) {
            /** @var $ex \RuntimeException */
            throw $ex;
        }
        return $contents;
    }
    /**
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     * Returns a UriInterface for the given value.
     *
     * This function accepts a string or UriInterface and returns a
     * UriInterface for the given value. If the value is already a
     * UriInterface, it is returned as-is.
     *
     * @param string|UriInterface $uri
     *
<<<<<<< HEAD
     * @throws \InvalidArgumentException
     */
    public static function uriFor($uri) : \YoastSEO_Vendor\Psr\Http\Message\UriInterface
=======
     * @return UriInterface
     *
     * @throws \InvalidArgumentException
     */
    public static function uriFor($uri)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($uri instanceof \YoastSEO_Vendor\Psr\Http\Message\UriInterface) {
            return $uri;
        }
        if (\is_string($uri)) {
            return new \YoastSEO_Vendor\GuzzleHttp\Psr7\Uri($uri);
        }
        throw new \InvalidArgumentException('URI must be a string or UriInterface');
    }
}
