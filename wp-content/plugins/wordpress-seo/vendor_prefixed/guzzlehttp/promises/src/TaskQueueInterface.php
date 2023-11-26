<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Promise;

interface TaskQueueInterface
{
    /**
     * Returns true if the queue is empty.
<<<<<<< HEAD
     */
    public function isEmpty() : bool;
=======
     *
     * @return bool
     */
    public function isEmpty();
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    /**
     * Adds a task to the queue that will be executed the next time run is
     * called.
     */
<<<<<<< HEAD
    public function add(callable $task) : void;
    /**
     * Execute all of the pending task in the queue.
     */
    public function run() : void;
=======
    public function add(callable $task);
    /**
     * Execute all of the pending task in the queue.
     */
    public function run();
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
}
