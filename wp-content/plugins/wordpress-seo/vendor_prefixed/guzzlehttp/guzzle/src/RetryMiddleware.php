<?php

namespace YoastSEO_Vendor\GuzzleHttp;

<<<<<<< HEAD
use YoastSEO_Vendor\GuzzleHttp\Promise as P;
use YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface;
=======
use YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface;
use YoastSEO_Vendor\GuzzleHttp\Promise\RejectedPromise;
use YoastSEO_Vendor\GuzzleHttp\Psr7;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\ResponseInterface;
/**
 * Middleware that retries requests based on the boolean result of
 * invoking the provided "decider" function.
<<<<<<< HEAD
 *
 * @final
 */
class RetryMiddleware
{
    /**
     * @var callable(RequestInterface, array): PromiseInterface
     */
    private $nextHandler;
    /**
     * @var callable
     */
    private $decider;
    /**
     * @var callable(int)
     */
    private $delay;
    /**
     * @param callable                                            $decider     Function that accepts the number of retries,
     *                                                                         a request, [response], and [exception] and
     *                                                                         returns true if the request is to be
     *                                                                         retried.
     * @param callable(RequestInterface, array): PromiseInterface $nextHandler Next handler to invoke.
     * @param (callable(int): int)|null                           $delay       Function that accepts the number of retries
     *                                                                         and returns the number of
     *                                                                         milliseconds to delay.
=======
 */
class RetryMiddleware
{
    /** @var callable  */
    private $nextHandler;
    /** @var callable */
    private $decider;
    /** @var callable */
    private $delay;
    /**
     * @param callable $decider     Function that accepts the number of retries,
     *                              a request, [response], and [exception] and
     *                              returns true if the request is to be
     *                              retried.
     * @param callable $nextHandler Next handler to invoke.
     * @param callable $delay       Function that accepts the number of retries
     *                              and [response] and returns the number of
     *                              milliseconds to delay.
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function __construct(callable $decider, callable $nextHandler, callable $delay = null)
    {
        $this->decider = $decider;
        $this->nextHandler = $nextHandler;
        $this->delay = $delay ?: __CLASS__ . '::exponentialDelay';
    }
    /**
     * Default exponential backoff delay function.
     *
<<<<<<< HEAD
     * @return int milliseconds.
     */
    public static function exponentialDelay(int $retries) : int
    {
        return (int) 2 ** ($retries - 1) * 1000;
    }
    public function __invoke(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
=======
     * @param int $retries
     *
     * @return int milliseconds.
     */
    public static function exponentialDelay($retries)
    {
        return (int) \pow(2, $retries - 1) * 1000;
    }
    /**
     * @param RequestInterface $request
     * @param array            $options
     *
     * @return PromiseInterface
     */
    public function __invoke(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!isset($options['retries'])) {
            $options['retries'] = 0;
        }
        $fn = $this->nextHandler;
        return $fn($request, $options)->then($this->onFulfilled($request, $options), $this->onRejected($request, $options));
    }
    /**
     * Execute fulfilled closure
<<<<<<< HEAD
     */
    private function onFulfilled(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options) : callable
    {
        return function ($value) use($request, $options) {
            if (!($this->decider)($options['retries'], $request, $value, null)) {
                return $value;
            }
            return $this->doRetry($request, $options, $value);
=======
     *
     * @return mixed
     */
    private function onFulfilled(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $req, array $options)
    {
        return function ($value) use($req, $options) {
            if (!\call_user_func($this->decider, $options['retries'], $req, $value, null)) {
                return $value;
            }
            return $this->doRetry($req, $options, $value);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        };
    }
    /**
     * Execute rejected closure
<<<<<<< HEAD
     */
    private function onRejected(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $req, array $options) : callable
    {
        return function ($reason) use($req, $options) {
            if (!($this->decider)($options['retries'], $req, null, $reason)) {
                return \YoastSEO_Vendor\GuzzleHttp\Promise\Create::rejectionFor($reason);
=======
     *
     * @return callable
     */
    private function onRejected(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $req, array $options)
    {
        return function ($reason) use($req, $options) {
            if (!\call_user_func($this->decider, $options['retries'], $req, null, $reason)) {
                return \YoastSEO_Vendor\GuzzleHttp\Promise\rejection_for($reason);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            }
            return $this->doRetry($req, $options);
        };
    }
<<<<<<< HEAD
    private function doRetry(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response = null) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
    {
        $options['delay'] = ($this->delay)(++$options['retries'], $response, $request);
=======
    /**
     * @return self
     */
    private function doRetry(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response = null)
    {
        $options['delay'] = \call_user_func($this->delay, ++$options['retries'], $response);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        return $this($request, $options);
    }
}
