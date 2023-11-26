<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Promise;

final class Is
{
    /**
     * Returns true if a promise is pending.
<<<<<<< HEAD
     */
    public static function pending(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise) : bool
=======
     *
     * @return bool
     */
    public static function pending(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $promise->getState() === \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled or rejected.
<<<<<<< HEAD
     */
    public static function settled(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise) : bool
=======
     *
     * @return bool
     */
    public static function settled(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $promise->getState() !== \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled.
<<<<<<< HEAD
     */
    public static function fulfilled(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise) : bool
=======
     *
     * @return bool
     */
    public static function fulfilled(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $promise->getState() === \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::FULFILLED;
    }
    /**
     * Returns true if a promise is rejected.
<<<<<<< HEAD
     */
    public static function rejected(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise) : bool
=======
     *
     * @return bool
     */
    public static function rejected(\YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface $promise)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $promise->getState() === \YoastSEO_Vendor\GuzzleHttp\Promise\PromiseInterface::REJECTED;
    }
}
