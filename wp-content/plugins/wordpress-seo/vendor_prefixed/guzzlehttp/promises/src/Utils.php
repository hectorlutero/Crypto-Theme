<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Promise;

final class Utils
{
    /**
     * Get the global task queue used for promise resolution.
     *
     * This task queue MUST be run in an event loop in order for promises to be
     * settled asynchronously. It will be automatically run when synchronously
     * waiting on a promise.
     *
     * <code>
     * while ($eventLoop->isRunning()) {
     *     GuzzleHttp\Promise\Utils::queue()->run();
     * }
     * </code>
     *
<<<<<<< HEAD
     * @param TaskQueueInterface|null $assign Optionally specify a new queue instance.
     */
    public static function queue(\YoastSEO_Vendor\GuzzleHttp\Promise\TaskQueueInterface $assign = null) : \YoastSEO_Vendor\GuzzleHttp\Promise\TaskQueueInterface
=======
     * @param TaskQueueInterface $assign Optionally specify a new queue instance.
     *
     * @return TaskQueueInterface
     */
    public static function queue(\YoastSEO_Vendor\GuzzleHttp\Promise\TaskQueueInterface $assign = null)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        static $queue;
        if ($assign) {
            $queue = $assign;
        } elseif (!$queue) {
            $queue = new \YoastSEO_Vendor\GuzzleHttp\Promise\TaskQueue();
        }
        return $queue;
    }
    /**
     * Adds a function to run in the task queue when it is next `run()` and
     * returns a promise that is fulfilled or rejected with the result.
     *
     * @param callable $task Task function to run.
<<<<<<< HEAD
     */
    public static function task(callable $task) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
    {
        $queue = self::queue();
        $promise = new \YoastSEO_Vendor\GuzzleHttp\Promise\Promise([$queue, 'run']);
        $queue->add(function () use($task, $promise) : void {
=======
     *
     * @return PromiseInterface
     */
    public static function task(callable $task)
    {
        $queue = self::queue();
        $promise = new \YoastSEO_Vendor\GuzzleHttp\Promise\Promise([$queue, 'run']);
        $queue->add(function () use($task, $promise) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            try {
                if (\YoastSEO_Vendor\GuzzleHttp\Promise\Is::pending($promise)) {
                    $promise->resolve($task());
                }
            } catch (\Throwable $e) {
                $promise->reject($e);
<<<<<<< HEAD
=======
            } catch (\Exception $e) {
                $promise->reject($e);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            }
        });
        return $promise;
    }
    /**
     * Synchronously waits on a promise to resolve and returns an inspection
     * state array.
     *
     * Returns a state associative array containing a "state" key mapping to a
     * valid promise state. If the state of the promise is "fulfilled", the
     * array will contain a "value" key mapping to the fulfilled value of the
     * promise. If the promise is rejected, the array will contain a "reason"
     * key mapping to the rejection reason of the promise.
     *
     * @param PromiseInterface $promise Promise or value.
<<<<<<< HEAD
     */
    public static function inspect(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise) : array
=======
     *
     * @return array
     */
    public static function inspect(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        try {
            return ['state' => \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::FULFILLED, 'value' => $promise->wait()];
        } catch (\YoastSEO_Vendor\GuzzleHttp\Promise\RejectionException $e) {
            return ['state' => \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::REJECTED, 'reason' => $e->getReason()];
        } catch (\Throwable $e) {
            return ['state' => \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::REJECTED, 'reason' => $e];
<<<<<<< HEAD
=======
        } catch (\Exception $e) {
            return ['state' => \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::REJECTED, 'reason' => $e];
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        }
    }
    /**
     * Waits on all of the provided promises, but does not unwrap rejected
     * promises as thrown exception.
     *
     * Returns an array of inspection state arrays.
     *
     * @see inspect for the inspection state array format.
     *
     * @param PromiseInterface[] $promises Traversable of promises to wait upon.
<<<<<<< HEAD
     */
    public static function inspectAll($promises) : array
    {
        $results = [];
        foreach ($promises as $key => $promise) {
            $results[$key] = self::inspect($promise);
=======
     *
     * @return array
     */
    public static function inspectAll($promises)
    {
        $results = [];
        foreach ($promises as $key => $promise) {
            $results[$key] = inspect($promise);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        }
        return $results;
    }
    /**
     * Waits on all of the provided promises and returns the fulfilled values.
     *
     * Returns an array that contains the value of each promise (in the same
     * order the promises were provided). An exception is thrown if any of the
     * promises are rejected.
     *
     * @param iterable<PromiseInterface> $promises Iterable of PromiseInterface objects to wait on.
     *
<<<<<<< HEAD
     * @throws \Throwable on error
     */
    public static function unwrap($promises) : array
=======
     * @return array
     *
     * @throws \Exception on error
     * @throws \Throwable on error in PHP >=7
     */
    public static function unwrap($promises)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $results = [];
        foreach ($promises as $key => $promise) {
            $results[$key] = $promise->wait();
        }
        return $results;
    }
    /**
     * Given an array of promises, return a promise that is fulfilled when all
     * the items in the array are fulfilled.
     *
     * The promise's fulfillment value is an array with fulfillment values at
     * respective positions to the original array. If any promise in the array
     * rejects, the returned promise is rejected with the rejection reason.
     *
     * @param mixed $promises  Promises or values.
     * @param bool  $recursive If true, resolves new promises that might have been added to the stack during its own resolution.
<<<<<<< HEAD
     */
    public static function all($promises, bool $recursive = \false) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
    {
        $results = [];
        $promise = \YoastSEO_Vendor\GuzzleHttp\Promise\Each::of($promises, function ($value, $idx) use(&$results) : void {
            $results[$idx] = $value;
        }, function ($reason, $idx, \YoastSEO_Vendor\GuzzleHttp\Promise\Promise $aggregate) : void {
=======
     *
     * @return PromiseInterface
     */
    public static function all($promises, $recursive = \false)
    {
        $results = [];
        $promise = \YoastSEO_Vendor\GuzzleHttp\Promise\Each::of($promises, function ($value, $idx) use(&$results) {
            $results[$idx] = $value;
        }, function ($reason, $idx, \YoastSEO_Vendor\GuzzleHttp\Promise\Promise $aggregate) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $aggregate->reject($reason);
        })->then(function () use(&$results) {
            \ksort($results);
            return $results;
        });
        if (\true === $recursive) {
            $promise = $promise->then(function ($results) use($recursive, &$promises) {
                foreach ($promises as $promise) {
                    if (\YoastSEO_Vendor\GuzzleHttp\Promise\Is::pending($promise)) {
                        return self::all($promises, $recursive);
                    }
                }
                return $results;
            });
        }
        return $promise;
    }
    /**
     * Initiate a competitive race between multiple promises or values (values
     * will become immediately fulfilled promises).
     *
     * When count amount of promises have been fulfilled, the returned promise
     * is fulfilled with an array that contains the fulfillment values of the
     * winners in order of resolution.
     *
     * This promise is rejected with a {@see AggregateException} if the number
     * of fulfilled promises is less than the desired $count.
     *
     * @param int   $count    Total number of promises.
     * @param mixed $promises Promises or values.
<<<<<<< HEAD
     */
    public static function some(int $count, $promises) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
    {
        $results = [];
        $rejections = [];
        return \YoastSEO_Vendor\GuzzleHttp\Promise\Each::of($promises, function ($value, $idx, \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $p) use(&$results, $count) : void {
=======
     *
     * @return PromiseInterface
     */
    public static function some($count, $promises)
    {
        $results = [];
        $rejections = [];
        return \YoastSEO_Vendor\GuzzleHttp\Promise\Each::of($promises, function ($value, $idx, \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $p) use(&$results, $count) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            if (\YoastSEO_Vendor\GuzzleHttp\Promise\Is::settled($p)) {
                return;
            }
            $results[$idx] = $value;
            if (\count($results) >= $count) {
                $p->resolve(null);
            }
<<<<<<< HEAD
        }, function ($reason) use(&$rejections) : void {
=======
        }, function ($reason) use(&$rejections) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $rejections[] = $reason;
        })->then(function () use(&$results, &$rejections, $count) {
            if (\count($results) !== $count) {
                throw new \YoastSEO_Vendor\GuzzleHttp\Promise\AggregateException('Not enough promises to fulfill count', $rejections);
            }
            \ksort($results);
            return \array_values($results);
        });
    }
    /**
     * Like some(), with 1 as count. However, if the promise fulfills, the
     * fulfillment value is not an array of 1 but the value directly.
     *
     * @param mixed $promises Promises or values.
<<<<<<< HEAD
     */
    public static function any($promises) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
=======
     *
     * @return PromiseInterface
     */
    public static function any($promises)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return self::some(1, $promises)->then(function ($values) {
            return $values[0];
        });
    }
    /**
     * Returns a promise that is fulfilled when all of the provided promises have
     * been fulfilled or rejected.
     *
     * The returned promise is fulfilled with an array of inspection state arrays.
     *
     * @see inspect for the inspection state array format.
     *
     * @param mixed $promises Promises or values.
<<<<<<< HEAD
     */
    public static function settle($promises) : \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface
    {
        $results = [];
        return \YoastSEO_Vendor\GuzzleHttp\Promise\Each::of($promises, function ($value, $idx) use(&$results) : void {
            $results[$idx] = ['state' => \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::FULFILLED, 'value' => $value];
        }, function ($reason, $idx) use(&$results) : void {
=======
     *
     * @return PromiseInterface
     */
    public static function settle($promises)
    {
        $results = [];
        return \YoastSEO_Vendor\GuzzleHttp\Promise\Each::of($promises, function ($value, $idx) use(&$results) {
            $results[$idx] = ['state' => \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::FULFILLED, 'value' => $value];
        }, function ($reason, $idx) use(&$results) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $results[$idx] = ['state' => \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::REJECTED, 'reason' => $reason];
        })->then(function () use(&$results) {
            \ksort($results);
            return $results;
        });
    }
}
