<?php

namespace YoastSEO_Vendor\Psr\Log;

/**
 * Basic Implementation of LoggerAwareInterface.
 */
trait LoggerAwareTrait
{
    /**
     * The logger instance.
     *
<<<<<<< HEAD
     * @var LoggerInterface|null
=======
     * @var LoggerInterface
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    protected $logger;
    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(\YoastSEO_Vendor\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
