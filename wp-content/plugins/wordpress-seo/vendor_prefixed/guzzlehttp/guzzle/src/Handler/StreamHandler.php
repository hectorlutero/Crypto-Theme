<?php

namespace YoastSEO_Vendor\GuzzleHttp\Handler;

use YoastSEO_Vendor\GuzzleHttp\Exception\ConnectException;
use YoastSEO_Vendor\GuzzleHttp\Exception\RequestException;
<<<<<<< HEAD
use YoastSEO_Vendor\GuzzleHttp\Promise as P;
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
use YoastSEO_Vendor\GuzzleHttp\Promise\FulfilledPromise;
use YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface;
use YoastSEO_Vendor\GuzzleHttp\Psr7;
use YoastSEO_Vendor\GuzzleHttp\TransferStats;
use YoastSEO_Vendor\GuzzleHttp\Utils;
use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\ResponseInterface;
use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
<<<<<<< HEAD
use YoastSEO_Vendor\Psr\Http\Message\UriInterface;
/**
 * HTTP handler that uses PHP's HTTP stream wrapper.
 *
 * @final
 */
class StreamHandler
{
    /**
     * @var array
     */
=======
/**
 * HTTP handler that uses PHP's HTTP stream wrapper.
 */
class StreamHandler
{
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    private $lastHeaders = [];
    /**
     * Sends an HTTP request.
     *
     * @param RequestInterface $request Request to send.
     * @param array            $options Request transfer options.
<<<<<<< HEAD
     */
    public function __invoke(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
=======
     *
     * @return PromiseInterface
     */
    public function __invoke(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        // Sleep if there is a delay specified.
        if (isset($options['delay'])) {
            \usleep($options['delay'] * 1000);
        }
        $startTime = isset($options['on_stats']) ? \YoastSEO_Vendor\GuzzleHttp\Utils::currentTime() : null;
        try {
            // Does not support the expect header.
            $request = $request->withoutHeader('Expect');
            // Append a content-length header if body size is zero to match
            // cURL's behavior.
            if (0 === $request->getBody()->getSize()) {
                $request = $request->withHeader('Content-Length', '0');
            }
            return $this->createResponse($request, $options, $this->createStream($request, $options), $startTime);
        } catch (\InvalidArgumentException $e) {
            throw $e;
        } catch (\Exception $e) {
            // Determine if the error was a networking error.
            $message = $e->getMessage();
            // This list can probably get more comprehensive.
<<<<<<< HEAD
            if (\false !== \strpos($message, 'getaddrinfo') || \false !== \strpos($message, 'Connection refused') || \false !== \strpos($message, "couldn't connect to host") || \false !== \strpos($message, 'connection attempt failed')) {
                $e = new \YoastSEO_Vendor\GuzzleHttp\Exception\ConnectException($e->getMessage(), $request, $e);
            } else {
                $e = \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException::wrapException($request, $e);
            }
            $this->invokeStats($options, $request, $startTime, null, $e);
            return \YoastSEO_Vendor\GuzzleHttp\Promise\Create::rejectionFor($e);
        }
    }
    private function invokeStats(array $options, \YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, ?float $startTime, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response = null, \Throwable $error = null) : void
    {
        if (isset($options['on_stats'])) {
            $stats = new \YoastSEO_Vendor\GuzzleHttp\TransferStats($request, $response, \YoastSEO_Vendor\GuzzleHttp\Utils::currentTime() - $startTime, $error, []);
            $options['on_stats']($stats);
        }
    }
    /**
     * @param resource $stream
     */
    private function createResponse(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options, $stream, ?float $startTime) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
    {
        $hdrs = $this->lastHeaders;
        $this->lastHeaders = [];
        try {
            [$ver, $status, $reason, $headers] = \YoastSEO_Vendor\GuzzleHttp\Handler\HeaderProcessor::parseHeaders($hdrs);
        } catch (\Exception $e) {
            return \YoastSEO_Vendor\GuzzleHttp\Promise\Create::rejectionFor(new \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException('An error was encountered while creating the response', $request, null, $e));
        }
        [$stream, $headers] = $this->checkDecode($options, $headers, $stream);
        $stream = \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::streamFor($stream);
=======
            if (\strpos($message, 'getaddrinfo') || \strpos($message, 'Connection refused') || \strpos($message, "couldn't connect to host") || \strpos($message, "connection attempt failed")) {
                $e = new \YoastSEO_Vendor\GuzzleHttp\Exception\ConnectException($e->getMessage(), $request, $e);
            }
            $e = \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException::wrapException($request, $e);
            $this->invokeStats($options, $request, $startTime, null, $e);
            return \YoastSEO_Vendor\GuzzleHttp\Promise\rejection_for($e);
        }
    }
    private function invokeStats(array $options, \YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, $startTime, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response = null, $error = null)
    {
        if (isset($options['on_stats'])) {
            $stats = new \YoastSEO_Vendor\GuzzleHttp\TransferStats($request, $response, \YoastSEO_Vendor\GuzzleHttp\Utils::currentTime() - $startTime, $error, []);
            \call_user_func($options['on_stats'], $stats);
        }
    }
    private function createResponse(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options, $stream, $startTime)
    {
        $hdrs = $this->lastHeaders;
        $this->lastHeaders = [];
        $parts = \explode(' ', \array_shift($hdrs), 3);
        $ver = \explode('/', $parts[0])[1];
        $status = $parts[1];
        $reason = isset($parts[2]) ? $parts[2] : null;
        $headers = \YoastSEO_Vendor\GuzzleHttp\headers_from_lines($hdrs);
        list($stream, $headers) = $this->checkDecode($options, $headers, $stream);
        $stream = \YoastSEO_Vendor\GuzzleHttp\Psr7\stream_for($stream);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        $sink = $stream;
        if (\strcasecmp('HEAD', $request->getMethod())) {
            $sink = $this->createSink($stream, $options);
        }
<<<<<<< HEAD
        try {
            $response = new \YoastSEO_Vendor\GuzzleHttp\Psr7\Response($status, $headers, $sink, $ver, $reason);
        } catch (\Exception $e) {
            return \YoastSEO_Vendor\GuzzleHttp\Promise\Create::rejectionFor(new \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException('An error was encountered while creating the response', $request, null, $e));
        }
=======
        $response = new \YoastSEO_Vendor\GuzzleHttp\Psr7\Response($status, $headers, $sink, $ver, $reason);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        if (isset($options['on_headers'])) {
            try {
                $options['on_headers']($response);
            } catch (\Exception $e) {
<<<<<<< HEAD
                return \YoastSEO_Vendor\GuzzleHttp\Promise\Create::rejectionFor(new \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException('An error was encountered during the on_headers event', $request, $response, $e));
=======
                $msg = 'An error was encountered during the on_headers event';
                $ex = new \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException($msg, $request, $response, $e);
                return \YoastSEO_Vendor\GuzzleHttp\Promise\rejection_for($ex);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            }
        }
        // Do not drain when the request is a HEAD request because they have
        // no body.
        if ($sink !== $stream) {
            $this->drain($stream, $sink, $response->getHeaderLine('Content-Length'));
        }
        $this->invokeStats($options, $request, $startTime, $response, null);
        return new \YoastSEO_Vendor\GuzzleHttp\Promise\FulfilledPromise($response);
    }
<<<<<<< HEAD
    private function createSink(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, array $options) : \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
=======
    private function createSink(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, array $options)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!empty($options['stream'])) {
            return $stream;
        }
<<<<<<< HEAD
        $sink = $options['sink'] ?? \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::tryFopen('php://temp', 'r+');
        return \is_string($sink) ? new \YoastSEO_Vendor\GuzzleHttp\Psr7\LazyOpenStream($sink, 'w+') : \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::streamFor($sink);
    }
    /**
     * @param resource $stream
     */
    private function checkDecode(array $options, array $headers, $stream) : array
    {
        // Automatically decode responses when instructed.
        if (!empty($options['decode_content'])) {
            $normalizedKeys = \YoastSEO_Vendor\GuzzleHttp\Utils::normalizeHeaderKeys($headers);
            if (isset($normalizedKeys['content-encoding'])) {
                $encoding = $headers[$normalizedKeys['content-encoding']];
                if ($encoding[0] === 'gzip' || $encoding[0] === 'deflate') {
                    $stream = new \YoastSEO_Vendor\GuzzleHttp\Psr7\InflateStream(\YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::streamFor($stream));
=======
        $sink = isset($options['sink']) ? $options['sink'] : \fopen('php://temp', 'r+');
        return \is_string($sink) ? new \YoastSEO_Vendor\GuzzleHttp\Psr7\LazyOpenStream($sink, 'w+') : \YoastSEO_Vendor\GuzzleHttp\Psr7\stream_for($sink);
    }
    private function checkDecode(array $options, array $headers, $stream)
    {
        // Automatically decode responses when instructed.
        if (!empty($options['decode_content'])) {
            $normalizedKeys = \YoastSEO_Vendor\GuzzleHttp\normalize_header_keys($headers);
            if (isset($normalizedKeys['content-encoding'])) {
                $encoding = $headers[$normalizedKeys['content-encoding']];
                if ($encoding[0] === 'gzip' || $encoding[0] === 'deflate') {
                    $stream = new \YoastSEO_Vendor\GuzzleHttp\Psr7\InflateStream(\YoastSEO_Vendor\GuzzleHttp\Psr7\stream_for($stream));
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                    $headers['x-encoded-content-encoding'] = $headers[$normalizedKeys['content-encoding']];
                    // Remove content-encoding header
                    unset($headers[$normalizedKeys['content-encoding']]);
                    // Fix content-length header
                    if (isset($normalizedKeys['content-length'])) {
                        $headers['x-encoded-content-length'] = $headers[$normalizedKeys['content-length']];
                        $length = (int) $stream->getSize();
                        if ($length === 0) {
                            unset($headers[$normalizedKeys['content-length']]);
                        } else {
                            $headers[$normalizedKeys['content-length']] = [$length];
                        }
                    }
                }
            }
        }
        return [$stream, $headers];
    }
    /**
     * Drains the source stream into the "sink" client option.
     *
<<<<<<< HEAD
     * @param string $contentLength Header specifying the amount of
     *                              data to read.
     *
     * @throws \RuntimeException when the sink option is invalid.
     */
    private function drain(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $source, \YoastSEO_Vendor\Psr\Http\Message\StreamInterface $sink, string $contentLength) : \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
=======
     * @param StreamInterface $source
     * @param StreamInterface $sink
     * @param string          $contentLength Header specifying the amount of
     *                                       data to read.
     *
     * @return StreamInterface
     * @throws \RuntimeException when the sink option is invalid.
     */
    private function drain(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $source, \YoastSEO_Vendor\Psr\Http\Message\StreamInterface $sink, $contentLength)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        // If a content-length header is provided, then stop reading once
        // that number of bytes has been read. This can prevent infinitely
        // reading from a stream when dealing with servers that do not honor
        // Connection: Close headers.
<<<<<<< HEAD
        \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::copyToStream($source, $sink, \strlen($contentLength) > 0 && (int) $contentLength > 0 ? (int) $contentLength : -1);
=======
        \YoastSEO_Vendor\GuzzleHttp\Psr7\copy_to_stream($source, $sink, \strlen($contentLength) > 0 && (int) $contentLength > 0 ? (int) $contentLength : -1);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        $sink->seek(0);
        $source->close();
        return $sink;
    }
    /**
     * Create a resource and check to ensure it was created successfully
     *
     * @param callable $callback Callable that returns stream resource
     *
     * @return resource
<<<<<<< HEAD
     *
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     * @throws \RuntimeException on error
     */
    private function createResource(callable $callback)
    {
<<<<<<< HEAD
        $errors = [];
        \set_error_handler(static function ($_, $msg, $file, $line) use(&$errors) : bool {
            $errors[] = ['message' => $msg, 'file' => $file, 'line' => $line];
            return \true;
        });
        try {
            $resource = $callback();
        } finally {
            \restore_error_handler();
        }
=======
        $errors = null;
        \set_error_handler(function ($_, $msg, $file, $line) use(&$errors) {
            $errors[] = ['message' => $msg, 'file' => $file, 'line' => $line];
            return \true;
        });
        $resource = $callback();
        \restore_error_handler();
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        if (!$resource) {
            $message = 'Error creating resource: ';
            foreach ($errors as $err) {
                foreach ($err as $key => $value) {
                    $message .= "[{$key}] {$value}" . \PHP_EOL;
                }
            }
            throw new \RuntimeException(\trim($message));
        }
        return $resource;
    }
<<<<<<< HEAD
    /**
     * @return resource
     */
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    private function createStream(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options)
    {
        static $methods;
        if (!$methods) {
            $methods = \array_flip(\get_class_methods(__CLASS__));
        }
<<<<<<< HEAD
        if (!\in_array($request->getUri()->getScheme(), ['http', 'https'])) {
            throw new \YoastSEO_Vendor\GuzzleHttp\Exception\RequestException(\sprintf("The scheme '%s' is not supported.", $request->getUri()->getScheme()), $request);
        }
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        // HTTP/1.1 streams using the PHP stream wrapper require a
        // Connection: close header
        if ($request->getProtocolVersion() == '1.1' && !$request->hasHeader('Connection')) {
            $request = $request->withHeader('Connection', 'close');
        }
        // Ensure SSL is verified by default
        if (!isset($options['verify'])) {
            $options['verify'] = \true;
        }
        $params = [];
        $context = $this->getDefaultContext($request);
        if (isset($options['on_headers']) && !\is_callable($options['on_headers'])) {
            throw new \InvalidArgumentException('on_headers must be callable');
        }
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $method = "add_{$key}";
                if (isset($methods[$method])) {
                    $this->{$method}($request, $context, $value, $params);
                }
            }
        }
        if (isset($options['stream_context'])) {
            if (!\is_array($options['stream_context'])) {
                throw new \InvalidArgumentException('stream_context must be an array');
            }
            $context = \array_replace_recursive($context, $options['stream_context']);
        }
        // Microsoft NTLM authentication only supported with curl handler
<<<<<<< HEAD
        if (isset($options['auth'][2]) && 'ntlm' === $options['auth'][2]) {
            throw new \InvalidArgumentException('Microsoft NTLM authentication only supported with curl handler');
        }
        $uri = $this->resolveHost($request, $options);
        $contextResource = $this->createResource(static function () use($context, $params) {
            return \stream_context_create($context, $params);
        });
        return $this->createResource(function () use($uri, &$http_response_header, $contextResource, $context, $options, $request) {
            $resource = @\fopen((string) $uri, 'r', \false, $contextResource);
            $this->lastHeaders = $http_response_header ?? [];
            if (\false === $resource) {
                throw new \YoastSEO_Vendor\GuzzleHttp\Exception\ConnectException(\sprintf('Connection refused for URI %s', $uri), $request, null, $context);
            }
=======
        if (isset($options['auth']) && \is_array($options['auth']) && isset($options['auth'][2]) && 'ntlm' == $options['auth'][2]) {
            throw new \InvalidArgumentException('Microsoft NTLM authentication only supported with curl handler');
        }
        $uri = $this->resolveHost($request, $options);
        $context = $this->createResource(function () use($context, $params) {
            return \stream_context_create($context, $params);
        });
        return $this->createResource(function () use($uri, &$http_response_header, $context, $options) {
            $resource = \fopen((string) $uri, 'r', null, $context);
            $this->lastHeaders = $http_response_header;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            if (isset($options['read_timeout'])) {
                $readTimeout = $options['read_timeout'];
                $sec = (int) $readTimeout;
                $usec = ($readTimeout - $sec) * 100000;
                \stream_set_timeout($resource, $sec, $usec);
            }
            return $resource;
        });
    }
<<<<<<< HEAD
    private function resolveHost(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options) : \YoastSEO_Vendor\Psr\Http\Message\UriInterface
=======
    private function resolveHost(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $uri = $request->getUri();
        if (isset($options['force_ip_resolve']) && !\filter_var($uri->getHost(), \FILTER_VALIDATE_IP)) {
            if ('v4' === $options['force_ip_resolve']) {
                $records = \dns_get_record($uri->getHost(), \DNS_A);
<<<<<<< HEAD
                if (\false === $records || !isset($records[0]['ip'])) {
                    throw new \YoastSEO_Vendor\GuzzleHttp\Exception\ConnectException(\sprintf("Could not resolve IPv4 address for host '%s'", $uri->getHost()), $request);
                }
                return $uri->withHost($records[0]['ip']);
            }
            if ('v6' === $options['force_ip_resolve']) {
                $records = \dns_get_record($uri->getHost(), \DNS_AAAA);
                if (\false === $records || !isset($records[0]['ipv6'])) {
                    throw new \YoastSEO_Vendor\GuzzleHttp\Exception\ConnectException(\sprintf("Could not resolve IPv6 address for host '%s'", $uri->getHost()), $request);
                }
                return $uri->withHost('[' . $records[0]['ipv6'] . ']');
=======
                if (!isset($records[0]['ip'])) {
                    throw new \YoastSEO_Vendor\GuzzleHttp\Exception\ConnectException(\sprintf("Could not resolve IPv4 address for host '%s'", $uri->getHost()), $request);
                }
                $uri = $uri->withHost($records[0]['ip']);
            } elseif ('v6' === $options['force_ip_resolve']) {
                $records = \dns_get_record($uri->getHost(), \DNS_AAAA);
                if (!isset($records[0]['ipv6'])) {
                    throw new \YoastSEO_Vendor\GuzzleHttp\Exception\ConnectException(\sprintf("Could not resolve IPv6 address for host '%s'", $uri->getHost()), $request);
                }
                $uri = $uri->withHost('[' . $records[0]['ipv6'] . ']');
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            }
        }
        return $uri;
    }
<<<<<<< HEAD
    private function getDefaultContext(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request) : array
=======
    private function getDefaultContext(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $headers = '';
        foreach ($request->getHeaders() as $name => $value) {
            foreach ($value as $val) {
                $headers .= "{$name}: {$val}\r\n";
            }
        }
<<<<<<< HEAD
        $context = ['http' => ['method' => $request->getMethod(), 'header' => $headers, 'protocol_version' => $request->getProtocolVersion(), 'ignore_errors' => \true, 'follow_location' => 0], 'ssl' => ['peer_name' => $request->getUri()->getHost()]];
        $body = (string) $request->getBody();
        if ('' !== $body) {
=======
        $context = ['http' => ['method' => $request->getMethod(), 'header' => $headers, 'protocol_version' => $request->getProtocolVersion(), 'ignore_errors' => \true, 'follow_location' => 0]];
        $body = (string) $request->getBody();
        if (!empty($body)) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $context['http']['content'] = $body;
            // Prevent the HTTP handler from adding a Content-Type header.
            if (!$request->hasHeader('Content-Type')) {
                $context['http']['header'] .= "Content-Type:\r\n";
            }
        }
        $context['http']['header'] = \rtrim($context['http']['header']);
        return $context;
    }
<<<<<<< HEAD
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_proxy(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array &$options, $value, array &$params) : void
    {
        $uri = null;
        if (!\is_array($value)) {
            $uri = $value;
        } else {
            $scheme = $request->getUri()->getScheme();
            if (isset($value[$scheme])) {
                if (!isset($value['no']) || !\YoastSEO_Vendor\GuzzleHttp\Utils::isHostInNoProxy($request->getUri()->getHost(), $value['no'])) {
                    $uri = $value[$scheme];
                }
            }
        }
        if (!$uri) {
            return;
        }
        $parsed = $this->parse_proxy($uri);
        $options['http']['proxy'] = $parsed['proxy'];
        if ($parsed['auth']) {
            if (!isset($options['http']['header'])) {
                $options['http']['header'] = [];
            }
            $options['http']['header'] .= "\r\nProxy-Authorization: {$parsed['auth']}";
        }
    }
    /**
     * Parses the given proxy URL to make it compatible with the format PHP's stream context expects.
     */
    private function parse_proxy(string $url) : array
    {
        $parsed = \parse_url($url);
        if ($parsed !== \false && isset($parsed['scheme']) && $parsed['scheme'] === 'http') {
            if (isset($parsed['host']) && isset($parsed['port'])) {
                $auth = null;
                if (isset($parsed['user']) && isset($parsed['pass'])) {
                    $auth = \base64_encode("{$parsed['user']}:{$parsed['pass']}");
                }
                return ['proxy' => "tcp://{$parsed['host']}:{$parsed['port']}", 'auth' => $auth ? "Basic {$auth}" : null];
            }
        }
        // Return proxy as-is.
        return ['proxy' => $url, 'auth' => null];
    }
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_timeout(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array &$options, $value, array &$params) : void
=======
    private function add_proxy(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, &$options, $value, &$params)
    {
        if (!\is_array($value)) {
            $options['http']['proxy'] = $value;
        } else {
            $scheme = $request->getUri()->getScheme();
            if (isset($value[$scheme])) {
                if (!isset($value['no']) || !\YoastSEO_Vendor\GuzzleHttp\is_host_in_noproxy($request->getUri()->getHost(), $value['no'])) {
                    $options['http']['proxy'] = $value[$scheme];
                }
            }
        }
    }
    private function add_timeout(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, &$options, $value, &$params)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($value > 0) {
            $options['http']['timeout'] = $value;
        }
    }
<<<<<<< HEAD
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_crypto_method(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array &$options, $value, array &$params) : void
    {
        if ($value === \STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT || $value === \STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT || $value === \STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT || \defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT') && $value === \STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT) {
            $options['http']['crypto_method'] = $value;
            return;
        }
        throw new \InvalidArgumentException('Invalid crypto_method request option: unknown version provided');
    }
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_verify(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array &$options, $value, array &$params) : void
    {
        if ($value === \false) {
            $options['ssl']['verify_peer'] = \false;
            $options['ssl']['verify_peer_name'] = \false;
            return;
        }
        if (\is_string($value)) {
=======
    private function add_verify(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, &$options, $value, &$params)
    {
        if ($value === \true) {
            // PHP 5.6 or greater will find the system cert by default. When
            // < 5.6, use the Guzzle bundled cacert.
            if (\PHP_VERSION_ID < 50600) {
                $options['ssl']['cafile'] = \YoastSEO_Vendor\GuzzleHttp\default_ca_bundle();
            }
        } elseif (\is_string($value)) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $options['ssl']['cafile'] = $value;
            if (!\file_exists($value)) {
                throw new \RuntimeException("SSL CA bundle not found: {$value}");
            }
<<<<<<< HEAD
        } elseif ($value !== \true) {
=======
        } elseif ($value === \false) {
            $options['ssl']['verify_peer'] = \false;
            $options['ssl']['verify_peer_name'] = \false;
            return;
        } else {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            throw new \InvalidArgumentException('Invalid verify request option');
        }
        $options['ssl']['verify_peer'] = \true;
        $options['ssl']['verify_peer_name'] = \true;
        $options['ssl']['allow_self_signed'] = \false;
    }
<<<<<<< HEAD
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_cert(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array &$options, $value, array &$params) : void
=======
    private function add_cert(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, &$options, $value, &$params)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (\is_array($value)) {
            $options['ssl']['passphrase'] = $value[1];
            $value = $value[0];
        }
        if (!\file_exists($value)) {
            throw new \RuntimeException("SSL certificate not found: {$value}");
        }
        $options['ssl']['local_cert'] = $value;
    }
<<<<<<< HEAD
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_progress(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array &$options, $value, array &$params) : void
    {
        self::addNotification($params, static function ($code, $a, $b, $c, $transferred, $total) use($value) {
            if ($code == \STREAM_NOTIFY_PROGRESS) {
                // The upload progress cannot be determined. Use 0 for cURL compatibility:
                // https://curl.se/libcurl/c/CURLOPT_PROGRESSFUNCTION.html
                $value($total, $transferred, 0, 0);
            }
        });
    }
    /**
     * @param mixed $value as passed via Request transfer options.
     */
    private function add_debug(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array &$options, $value, array &$params) : void
=======
    private function add_progress(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, &$options, $value, &$params)
    {
        $this->addNotification($params, function ($code, $a, $b, $c, $transferred, $total) use($value) {
            if ($code == \STREAM_NOTIFY_PROGRESS) {
                $value($total, $transferred, null, null);
            }
        });
    }
    private function add_debug(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, &$options, $value, &$params)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($value === \false) {
            return;
        }
        static $map = [\STREAM_NOTIFY_CONNECT => 'CONNECT', \STREAM_NOTIFY_AUTH_REQUIRED => 'AUTH_REQUIRED', \STREAM_NOTIFY_AUTH_RESULT => 'AUTH_RESULT', \STREAM_NOTIFY_MIME_TYPE_IS => 'MIME_TYPE_IS', \STREAM_NOTIFY_FILE_SIZE_IS => 'FILE_SIZE_IS', \STREAM_NOTIFY_REDIRECTED => 'REDIRECTED', \STREAM_NOTIFY_PROGRESS => 'PROGRESS', \STREAM_NOTIFY_FAILURE => 'FAILURE', \STREAM_NOTIFY_COMPLETED => 'COMPLETED', \STREAM_NOTIFY_RESOLVE => 'RESOLVE'];
        static $args = ['severity', 'message', 'message_code', 'bytes_transferred', 'bytes_max'];
<<<<<<< HEAD
        $value = \YoastSEO_Vendor\GuzzleHttp\Utils::debugResource($value);
        $ident = $request->getMethod() . ' ' . $request->getUri()->withFragment('');
        self::addNotification($params, static function (int $code, ...$passed) use($ident, $value, $map, $args) : void {
=======
        $value = \YoastSEO_Vendor\GuzzleHttp\debug_resource($value);
        $ident = $request->getMethod() . ' ' . $request->getUri()->withFragment('');
        $this->addNotification($params, function () use($ident, $value, $map, $args) {
            $passed = \func_get_args();
            $code = \array_shift($passed);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            \fprintf($value, '<%s> [%s] ', $ident, $map[$code]);
            foreach (\array_filter($passed) as $i => $v) {
                \fwrite($value, $args[$i] . ': "' . $v . '" ');
            }
            \fwrite($value, "\n");
        });
    }
<<<<<<< HEAD
    private static function addNotification(array &$params, callable $notify) : void
=======
    private function addNotification(array &$params, callable $notify)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        // Wrap the existing function if needed.
        if (!isset($params['notification'])) {
            $params['notification'] = $notify;
        } else {
<<<<<<< HEAD
            $params['notification'] = self::callArray([$params['notification'], $notify]);
        }
    }
    private static function callArray(array $functions) : callable
    {
        return static function (...$args) use($functions) {
            foreach ($functions as $fn) {
                $fn(...$args);
=======
            $params['notification'] = $this->callArray([$params['notification'], $notify]);
        }
    }
    private function callArray(array $functions)
    {
        return function () use($functions) {
            $args = \func_get_args();
            foreach ($functions as $fn) {
                \call_user_func_array($fn, $args);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            }
        };
    }
}
