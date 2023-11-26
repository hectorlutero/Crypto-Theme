<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Promise;

/**
 * Exception thrown when too many errors occur in the some() or any() methods.
 */
class AggregateException extends \YoastSEO_Vendor\GuzzleHttp\Promise\RejectionException
{
<<<<<<< HEAD
    public function __construct(string $msg, array $reasons)
=======
    public function __construct($msg, array $reasons)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        parent::__construct($reasons, \sprintf('%s; %d rejected promises', $msg, \count($reasons)));
    }
}
