<?php

namespace YoastSEO_Vendor\GuzzleHttp;

use YoastSEO_Vendor\GuzzleHttp\Exception\BadResponseException;
use YoastSEO_Vendor\GuzzleHttp\Exception\TooManyRedirectsException;
use YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface;
<<<<<<< HEAD
=======
use YoastSEO_Vendor\GuzzleHttp\Psr7;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\ResponseInterface;
use YoastSEO_Vendor\Psr\Http\Message\UriInterface;
/**
 * Request redirect middleware.
 *
 * Apply this middleware like other middleware using
 * {@see \GuzzleHttp\Middleware::redirect()}.
<<<<<<< HEAD
 *
 * @final
 */
class RedirectMiddleware
{
    public const HISTORY_HEADER = 'X-Guzzle-Redirect-History';
    public const STATUS_HISTORY_HEADER = 'X-Guzzle-Redirect-Status-History';
    /**
     * @var array
     */
    public static $defaultSettings = ['max' => 5, 'protocols' => ['http', 'https'], 'strict' => \false, 'referer' => \false, 'track_redirects' => \false];
    /**
     * @var callable(RequestInterface, array): PromiseInterface
     */
    private $nextHandler;
    /**
     * @param callable(RequestInterface, array): PromiseInterface $nextHandler Next handler to invoke.
=======
 */
class RedirectMiddleware
{
    const HISTORY_HEADER = 'X-Guzzle-Redirect-History';
    const STATUS_HISTORY_HEADER = 'X-Guzzle-Redirect-Status-History';
    public static $defaultSettings = ['max' => 5, 'protocols' => ['http', 'https'], 'strict' => \false, 'referer' => \false, 'track_redirects' => \false];
    /** @var callable  */
    private $nextHandler;
    /**
     * @param callable $nextHandler Next handler to invoke.
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function __construct(callable $nextHandler)
    {
        $this->nextHandler = $nextHandler;
    }
<<<<<<< HEAD
    public function __invoke(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
=======
    /**
     * @param RequestInterface $request
     * @param array            $options
     *
     * @return PromiseInterface
     */
    public function __invoke(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $fn = $this->nextHandler;
        if (empty($options['allow_redirects'])) {
            return $fn($request, $options);
        }
        if ($options['allow_redirects'] === \true) {
            $options['allow_redirects'] = self::$defaultSettings;
        } elseif (!\is_array($options['allow_redirects'])) {
            throw new \InvalidArgumentException('allow_redirects must be true, false, or array');
        } else {
            // Merge the default settings with the provided settings
            $options['allow_redirects'] += self::$defaultSettings;
        }
        if (empty($options['allow_redirects']['max'])) {
            return $fn($request, $options);
        }
        return $fn($request, $options)->then(function (\YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response) use($request, $options) {
            return $this->checkRedirect($request, $options, $response);
        });
    }
    /**
<<<<<<< HEAD
=======
     * @param RequestInterface  $request
     * @param array             $options
     * @param ResponseInterface $response
     *
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     * @return ResponseInterface|PromiseInterface
     */
    public function checkRedirect(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response)
    {
<<<<<<< HEAD
        if (\strpos((string) $response->getStatusCode(), '3') !== 0 || !$response->hasHeader('Location')) {
            return $response;
        }
        $this->guardMax($request, $response, $options);
=======
        if (\substr($response->getStatusCode(), 0, 1) != '3' || !$response->hasHeader('Location')) {
            return $response;
        }
        $this->guardMax($request, $options);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        $nextRequest = $this->modifyRequest($request, $options, $response);
        // If authorization is handled by curl, unset it if URI is cross-origin.
        if (\YoastSEO_Vendor\GuzzleHttp\Psr7\UriComparator::isCrossOrigin($request->getUri(), $nextRequest->getUri()) && \defined('\\CURLOPT_HTTPAUTH')) {
            unset($options['curl'][\CURLOPT_HTTPAUTH], $options['curl'][\CURLOPT_USERPWD]);
        }
        if (isset($options['allow_redirects']['on_redirect'])) {
<<<<<<< HEAD
            $options['allow_redirects']['on_redirect']($request, $response, $nextRequest->getUri());
        }
=======
            \call_user_func($options['allow_redirects']['on_redirect'], $request, $response, $nextRequest->getUri());
        }
        /** @var PromiseInterface|ResponseInterface $promise */
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        $promise = $this($nextRequest, $options);
        // Add headers to be able to track history of redirects.
        if (!empty($options['allow_redirects']['track_redirects'])) {
            return $this->withTracking($promise, (string) $nextRequest->getUri(), $response->getStatusCode());
        }
        return $promise;
    }
    /**
     * Enable tracking on promise.
<<<<<<< HEAD
     */
    private function withTracking(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise, string $uri, int $statusCode) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
    {
        return $promise->then(static function (\YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response) use($uri, $statusCode) {
=======
     *
     * @return PromiseInterface
     */
    private function withTracking(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise, $uri, $statusCode)
    {
        return $promise->then(function (\YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response) use($uri, $statusCode) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            // Note that we are pushing to the front of the list as this
            // would be an earlier response than what is currently present
            // in the history header.
            $historyHeader = $response->getHeader(self::HISTORY_HEADER);
            $statusHeader = $response->getHeader(self::STATUS_HISTORY_HEADER);
            \array_unshift($historyHeader, $uri);
<<<<<<< HEAD
            \array_unshift($statusHeader, (string) $statusCode);
=======
            \array_unshift($statusHeader, $statusCode);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            return $response->withHeader(self::HISTORY_HEADER, $historyHeader)->withHeader(self::STATUS_HISTORY_HEADER, $statusHeader);
        });
    }
    /**
     * Check for too many redirects.
     *
<<<<<<< HEAD
     * @throws TooManyRedirectsException Too many redirects.
     */
    private function guardMax(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response, array &$options) : void
    {
        $current = $options['__redirect_count'] ?? 0;
        $options['__redirect_count'] = $current + 1;
        $max = $options['allow_redirects']['max'];
        if ($options['__redirect_count'] > $max) {
            throw new \YoastSEO_Vendor\GuzzleHttp\Exception\TooManyRedirectsException("Will not follow more than {$max} redirects", $request, $response);
        }
    }
    public function modifyRequest(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response) : \YoastSEO_Vendor\Psr\Http\Message\RequestInterface
=======
     * @return void
     *
     * @throws TooManyRedirectsException Too many redirects.
     */
    private function guardMax(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array &$options)
    {
        $current = isset($options['__redirect_count']) ? $options['__redirect_count'] : 0;
        $options['__redirect_count'] = $current + 1;
        $max = $options['allow_redirects']['max'];
        if ($options['__redirect_count'] > $max) {
            throw new \YoastSEO_Vendor\GuzzleHttp\Exception\TooManyRedirectsException("Will not follow more than {$max} redirects", $request);
        }
    }
    /**
     * @param RequestInterface  $request
     * @param array             $options
     * @param ResponseInterface $response
     *
     * @return RequestInterface
     */
    public function modifyRequest(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        // Request modifications to apply.
        $modify = [];
        $protocols = $options['allow_redirects']['protocols'];
        // Use a GET request if this is an entity enclosing request and we are
        // not forcing RFC compliance, but rather emulating what all browsers
        // would do.
        $statusCode = $response->getStatusCode();
        if ($statusCode == 303 || $statusCode <= 302 && !$options['allow_redirects']['strict']) {
<<<<<<< HEAD
            $safeMethods = ['GET', 'HEAD', 'OPTIONS'];
            $requestMethod = $request->getMethod();
            $modify['method'] = \in_array($requestMethod, $safeMethods) ? $requestMethod : 'GET';
=======
            $modify['method'] = 'GET';
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $modify['body'] = '';
        }
        $uri = self::redirectUri($request, $response, $protocols);
        if (isset($options['idn_conversion']) && $options['idn_conversion'] !== \false) {
            $idnOptions = $options['idn_conversion'] === \true ? \IDNA_DEFAULT : $options['idn_conversion'];
            $uri = \YoastSEO_Vendor\GuzzleHttp\Utils::idnUriConvert($uri, $idnOptions);
        }
        $modify['uri'] = $uri;
<<<<<<< HEAD
        \YoastSEO_Vendor\GuzzleHttp\Psr7\Message::rewindBody($request);
=======
        \YoastSEO_Vendor\GuzzleHttp\Psr7\rewind_body($request);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        // Add the Referer header if it is told to do so and only
        // add the header if we are not redirecting from https to http.
        if ($options['allow_redirects']['referer'] && $modify['uri']->getScheme() === $request->getUri()->getScheme()) {
            $uri = $request->getUri()->withUserInfo('');
            $modify['set_headers']['Referer'] = (string) $uri;
        } else {
            $modify['remove_headers'][] = 'Referer';
        }
        // Remove Authorization and Cookie headers if URI is cross-origin.
        if (\YoastSEO_Vendor\GuzzleHttp\Psr7\UriComparator::isCrossOrigin($request->getUri(), $modify['uri'])) {
            $modify['remove_headers'][] = 'Authorization';
            $modify['remove_headers'][] = 'Cookie';
        }
<<<<<<< HEAD
        return \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::modifyRequest($request, $modify);
    }
    /**
     * Set the appropriate URL on the request based on the location header.
     */
    private static function redirectUri(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response, array $protocols) : \YoastSEO_Vendor\Psr\Http\Message\UriInterface
=======
        return \YoastSEO_Vendor\GuzzleHttp\Psr7\modify_request($request, $modify);
    }
    /**
     * Set the appropriate URL on the request based on the location header.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array             $protocols
     *
     * @return UriInterface
     */
    private static function redirectUri(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response, array $protocols)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $location = \YoastSEO_Vendor\GuzzleHttp\Psr7\UriResolver::resolve($request->getUri(), new \YoastSEO_Vendor\GuzzleHttp\Psr7\Uri($response->getHeaderLine('Location')));
        // Ensure that the redirect URI is allowed based on the protocols.
        if (!\in_array($location->getScheme(), $protocols)) {
            throw new \YoastSEO_Vendor\GuzzleHttp\Exception\BadResponseException(\sprintf('Redirect URI, %s, does not use one of the allowed redirect protocols: %s', $location, \implode(', ', $protocols)), $request, $response);
        }
        return $location;
    }
}
