<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Promise;

/**
 * Promises/A+ implementation that avoids recursion when possible.
 *
<<<<<<< HEAD
 * @see https://promisesaplus.com/
 *
 * @final
=======
 * @link https://promisesaplus.com/
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
 */
class Promise implements \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
{
    private $state = self::PENDING;
    private $result;
    private $cancelFn;
    private $waitFn;
    private $waitList;
    private $handlers = [];
    /**
     * @param callable $waitFn   Fn that when invoked resolves the promise.
     * @param callable $cancelFn Fn that when invoked cancels the promise.
     */
    public function __construct(callable $waitFn = null, callable $cancelFn = null)
    {
        $this->waitFn = $waitFn;
        $this->cancelFn = $cancelFn;
    }
<<<<<<< HEAD
    public function then(callable $onFulfilled = null, callable $onRejected = null) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
=======
    public function then(callable $onFulfilled = null, callable $onRejected = null)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($this->state === self::PENDING) {
            $p = new \YoastSEO_Vendor\GuzzleHttp\Promise\Promise(null, [$this, 'cancel']);
            $this->handlers[] = [$p, $onFulfilled, $onRejected];
            $p->waitList = $this->waitList;
            $p->waitList[] = $this;
            return $p;
        }
        // Return a fulfilled promise and immediately invoke any callbacks.
        if ($this->state === self::FULFILLED) {
            $promise = \YoastSEO_Vendor\GuzzleHttp\Promise\Create::promiseFor($this->result);
            return $onFulfilled ? $promise->then($onFulfilled) : $promise;
        }
        // It's either cancelled or rejected, so return a rejected promise
        // and immediately invoke any callbacks.
        $rejection = \YoastSEO_Vendor\GuzzleHttp\Promise\Create::rejectionFor($this->result);
        return $onRejected ? $rejection->then(null, $onRejected) : $rejection;
    }
<<<<<<< HEAD
    public function otherwise(callable $onRejected) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
    {
        return $this->then(null, $onRejected);
    }
    public function wait(bool $unwrap = \true)
=======
    public function otherwise(callable $onRejected)
    {
        return $this->then(null, $onRejected);
    }
    public function wait($unwrap = \true)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->waitIfPending();
        if ($this->result instanceof \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface) {
            return $this->result->wait($unwrap);
        }
        if ($unwrap) {
            if ($this->state === self::FULFILLED) {
                return $this->result;
            }
            // It's rejected so "unwrap" and throw an exception.
            throw \YoastSEO_Vendor\GuzzleHttp\Promise\Create::exceptionFor($this->result);
        }
    }
<<<<<<< HEAD
    public function getState() : string
    {
        return $this->state;
    }
    public function cancel() : void
=======
    public function getState()
    {
        return $this->state;
    }
    public function cancel()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($this->state !== self::PENDING) {
            return;
        }
        $this->waitFn = $this->waitList = null;
        if ($this->cancelFn) {
            $fn = $this->cancelFn;
            $this->cancelFn = null;
            try {
                $fn();
            } catch (\Throwable $e) {
                $this->reject($e);
<<<<<<< HEAD
=======
            } catch (\Exception $e) {
                $this->reject($e);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            }
        }
        // Reject the promise only if it wasn't rejected in a then callback.
        /** @psalm-suppress RedundantCondition */
        if ($this->state === self::PENDING) {
            $this->reject(new \YoastSEO_Vendor\GuzzleHttp\Promise\CancellationException('Promise has been cancelled'));
        }
    }
<<<<<<< HEAD
    public function resolve($value) : void
    {
        $this->settle(self::FULFILLED, $value);
    }
    public function reject($reason) : void
    {
        $this->settle(self::REJECTED, $reason);
    }
    private function settle(string $state, $value) : void
=======
    public function resolve($value)
    {
        $this->settle(self::FULFILLED, $value);
    }
    public function reject($reason)
    {
        $this->settle(self::REJECTED, $reason);
    }
    private function settle($state, $value)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($this->state !== self::PENDING) {
            // Ignore calls with the same resolution.
            if ($state === $this->state && $value === $this->result) {
                return;
            }
            throw $this->state === $state ? new \LogicException("The promise is already {$state}.") : new \LogicException("Cannot change a {$this->state} promise to {$state}");
        }
        if ($value === $this) {
            throw new \LogicException('Cannot fulfill or reject a promise with itself');
        }
        // Clear out the state of the promise but stash the handlers.
        $this->state = $state;
        $this->result = $value;
        $handlers = $this->handlers;
        $this->handlers = null;
        $this->waitList = $this->waitFn = null;
        $this->cancelFn = null;
        if (!$handlers) {
            return;
        }
        // If the value was not a settled promise or a thenable, then resolve
        // it in the task queue using the correct ID.
        if (!\is_object($value) || !\method_exists($value, 'then')) {
            $id = $state === self::FULFILLED ? 1 : 2;
            // It's a success, so resolve the handlers in the queue.
<<<<<<< HEAD
            \YoastSEO_Vendor\GuzzleHttp\Promise\Utils::queue()->add(static function () use($id, $value, $handlers) : void {
=======
            \YoastSEO_Vendor\GuzzleHttp\Promise\Utils::queue()->add(static function () use($id, $value, $handlers) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                foreach ($handlers as $handler) {
                    self::callHandler($id, $value, $handler);
                }
            });
        } elseif ($value instanceof \YoastSEO_Vendor\GuzzleHttp\Promise\Promise && \YoastSEO_Vendor\GuzzleHttp\Promise\Is::pending($value)) {
            // We can just merge our handlers onto the next promise.
            $value->handlers = \array_merge($value->handlers, $handlers);
        } else {
            // Resolve the handlers when the forwarded promise is resolved.
<<<<<<< HEAD
            $value->then(static function ($value) use($handlers) : void {
                foreach ($handlers as $handler) {
                    self::callHandler(1, $value, $handler);
                }
            }, static function ($reason) use($handlers) : void {
=======
            $value->then(static function ($value) use($handlers) {
                foreach ($handlers as $handler) {
                    self::callHandler(1, $value, $handler);
                }
            }, static function ($reason) use($handlers) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                foreach ($handlers as $handler) {
                    self::callHandler(2, $reason, $handler);
                }
            });
        }
    }
    /**
     * Call a stack of handlers using a specific callback index and value.
     *
     * @param int   $index   1 (resolve) or 2 (reject).
     * @param mixed $value   Value to pass to the callback.
     * @param array $handler Array of handler data (promise and callbacks).
     */
<<<<<<< HEAD
    private static function callHandler(int $index, $value, array $handler) : void
=======
    private static function callHandler($index, $value, array $handler)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        /** @var PromiseInterface $promise */
        $promise = $handler[0];
        // The promise may have been cancelled or resolved before placing
        // this thunk in the queue.
        if (\YoastSEO_Vendor\GuzzleHttp\Promise\Is::settled($promise)) {
            return;
        }
        try {
            if (isset($handler[$index])) {
                /*
                 * If $f throws an exception, then $handler will be in the exception
                 * stack trace. Since $handler contains a reference to the callable
                 * itself we get a circular reference. We clear the $handler
                 * here to avoid that memory leak.
                 */
                $f = $handler[$index];
                unset($handler);
                $promise->resolve($f($value));
            } elseif ($index === 1) {
                // Forward resolution values as-is.
                $promise->resolve($value);
            } else {
                // Forward rejections down the chain.
                $promise->reject($value);
            }
        } catch (\Throwable $reason) {
            $promise->reject($reason);
<<<<<<< HEAD
        }
    }
    private function waitIfPending() : void
=======
        } catch (\Exception $reason) {
            $promise->reject($reason);
        }
    }
    private function waitIfPending()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($this->state !== self::PENDING) {
            return;
        } elseif ($this->waitFn) {
            $this->invokeWaitFn();
        } elseif ($this->waitList) {
            $this->invokeWaitList();
        } else {
            // If there's no wait function, then reject the promise.
            $this->reject('Cannot wait on a promise that has ' . 'no internal wait function. You must provide a wait ' . 'function when constructing the promise to be able to ' . 'wait on a promise.');
        }
        \YoastSEO_Vendor\GuzzleHttp\Promise\Utils::queue()->run();
        /** @psalm-suppress RedundantCondition */
        if ($this->state === self::PENDING) {
            $this->reject('Invoking the wait callback did not resolve the promise');
        }
    }
<<<<<<< HEAD
    private function invokeWaitFn() : void
=======
    private function invokeWaitFn()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        try {
            $wfn = $this->waitFn;
            $this->waitFn = null;
            $wfn(\true);
<<<<<<< HEAD
        } catch (\Throwable $reason) {
=======
        } catch (\Exception $reason) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            if ($this->state === self::PENDING) {
                // The promise has not been resolved yet, so reject the promise
                // with the exception.
                $this->reject($reason);
            } else {
                // The promise was already resolved, so there's a problem in
                // the application.
                throw $reason;
            }
        }
    }
<<<<<<< HEAD
    private function invokeWaitList() : void
=======
    private function invokeWaitList()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $waitList = $this->waitList;
        $this->waitList = null;
        foreach ($waitList as $result) {
            do {
                $result->waitIfPending();
                $result = $result->result;
            } while ($result instanceof \YoastSEO_Vendor\GuzzleHttp\Promise\Promise);
            if ($result instanceof \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface) {
                $result->wait(\false);
            }
        }
    }
}
