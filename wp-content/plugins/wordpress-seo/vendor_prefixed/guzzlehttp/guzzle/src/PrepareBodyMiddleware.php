<?php

namespace YoastSEO_Vendor\GuzzleHttp;

use YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface;
<<<<<<< HEAD
=======
use YoastSEO_Vendor\GuzzleHttp\Psr7;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
/**
 * Prepares requests that contain a body, adding the Content-Length,
 * Content-Type, and Expect headers.
<<<<<<< HEAD
 *
 * @final
 */
class PrepareBodyMiddleware
{
    /**
     * @var callable(RequestInterface, array): PromiseInterface
     */
    private $nextHandler;
    /**
     * @param callable(RequestInterface, array): PromiseInterface $nextHandler Next handler to invoke.
=======
 */
class PrepareBodyMiddleware
{
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
        // Don't do anything if the request has no body.
        if ($request->getBody()->getSize() === 0) {
            return $fn($request, $options);
        }
        $modify = [];
        // Add a default content-type if possible.
        if (!$request->hasHeader('Content-Type')) {
            if ($uri = $request->getBody()->getMetadata('uri')) {
<<<<<<< HEAD
                if (\is_string($uri) && ($type = \YoastSEO_Vendor\GuzzleHttp\Psr7\MimeType::fromFilename($uri))) {
=======
                if ($type = \YoastSEO_Vendor\GuzzleHttp\Psr7\mimetype_from_filename($uri)) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                    $modify['set_headers']['Content-Type'] = $type;
                }
            }
        }
        // Add a default content-length or transfer-encoding header.
        if (!$request->hasHeader('Content-Length') && !$request->hasHeader('Transfer-Encoding')) {
            $size = $request->getBody()->getSize();
            if ($size !== null) {
                $modify['set_headers']['Content-Length'] = $size;
            } else {
                $modify['set_headers']['Transfer-Encoding'] = 'chunked';
            }
        }
        // Add the expect header if needed.
        $this->addExpectHeader($request, $options, $modify);
<<<<<<< HEAD
        return $fn(\YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::modifyRequest($request, $modify), $options);
    }
    /**
     * Add expect header
     */
    private function addExpectHeader(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options, array &$modify) : void
=======
        return $fn(\YoastSEO_Vendor\GuzzleHttp\Psr7\modify_request($request, $modify), $options);
    }
    /**
     * Add expect header
     *
     * @return void
     */
    private function addExpectHeader(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options, array &$modify)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        // Determine if the Expect header should be used
        if ($request->hasHeader('Expect')) {
            return;
        }
<<<<<<< HEAD
        $expect = $options['expect'] ?? null;
=======
        $expect = isset($options['expect']) ? $options['expect'] : null;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        // Return if disabled or if you're not using HTTP/1.1 or HTTP/2.0
        if ($expect === \false || $request->getProtocolVersion() < 1.1) {
            return;
        }
        // The expect header is unconditionally enabled
        if ($expect === \true) {
            $modify['set_headers']['Expect'] = '100-Continue';
            return;
        }
        // By default, send the expect header when the payload is > 1mb
        if ($expect === null) {
            $expect = 1048576;
        }
        // Always add if the body cannot be rewound, the size cannot be
        // determined, or the size is greater than the cutoff threshold
        $body = $request->getBody();
        $size = $body->getSize();
        if ($size === null || $size >= (int) $expect || !$body->isSeekable()) {
            $modify['set_headers']['Expect'] = '100-Continue';
        }
    }
}
